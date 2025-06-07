<?php

namespace App\Http\Controllers;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Pelanggan;
use App\Models\Layanan;
use App\Exports\PesananExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PesananController extends Controller
{
    
    public function index() {
        $pesanans = Pesanan::with(['pelanggan', 'details.layanan'])->latest()->paginate(10);

        $tahunList = Pesanan::selectRaw('YEAR(tanggal_terima) as tahun')->distinct()->pluck('tahun');

        return view('dataPesanan', compact('pesanans', 'tahunList'));
    }

    public function searchByNama(Request $request)
    {

        $pesanans = Pesanan::with('pelanggan', 'details.layanan')
        ->whereHas('pelanggan', function ($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->search_nama . '%');
        })->latest()->paginate(10);

        $tahunList = Pesanan::selectRaw('YEAR(tanggal_terima) as tahun')->distinct()->pluck('tahun');

        return view('dataPesanan', compact('pesanans', 'tahunList'));

    }

    public function detail(Request $request, $id)
    {
        $pesanan = Pesanan::with('pelanggan', 'details.layanan')->findorfail($id);

        return view('pesanan.detailPesanan', compact('pesanan'));
    }

    public function create(Request $request)
    {
        $kategori = $request->query('tipe');
        return view('pesanan.tambahPesanan', [
            'pelanggan' => Pelanggan::all(),
            'layanan' => Layanan::all(),
            'kategori' => $kategori,
        ]);
    }

    public function store(Request $request)
    {

        setlocale(LC_TIME, 'id_ID.utf8');
        Carbon::setLocale('id');

        // Format and parse the date
        $tanggal_terima = Carbon::parse($request->tanggal_terima);
        $tanggal_selesai = Carbon::parse($request->tanggal_selesai);
    
        // Merge dates back to the request for validation
        $request->merge([
            'tanggal_terima' => $tanggal_terima,
            'tanggal_selesai' => $tanggal_selesai,
        ]);

        // Validate the request
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'layanan_id.*' => 'required|exists:layanans,id',
            'jenis_barang.*' => 'required|string|max:255',
            'spesifikasi_barang.*' => 'nullable|string|max:255',
            'jumlah.*' => 'required|integer|min:1',
            'harga_satuan.*' => 'required|integer|min:0',
            'status_pembayaran' => 'required|string', 
            'tanggal_terima' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_terima',
        ]);

        // Create the pesanan record
        $pesanan = Pesanan::create([
            'user_id' => Auth::id(),
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal_terima' => $tanggal_terima,
            'tanggal_selesai' => $tanggal_selesai,
            'status_cucian' => 'Belum Dicuci',
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        // Create the pesanan detail records
        foreach ($request->layanan_id as $i => $layanan_id) {
            PesananDetail::create([
                'pesanan_id' => $pesanan->id,
                'layanan_id' => $layanan_id,
                'jenis_barang' => $request->jenis_barang[$i],
                'spesifikasi_barang' => $request->spesifikasi_barang[$i] ?? '',
                'jumlah' => $request->jumlah[$i],
                'harga_satuan' => $request->harga_satuan[$i],
                'total_harga' => $request->jumlah[$i] * $request->harga_satuan[$i],
            ]);
        }

        // Redirect with a success message
        return redirect()->route('pesanan.index')->with('status', 'Pesanan berhasil disimpan.');
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $pesanan->delete();
        PesananDetail::where('pesanan_id', $id)->delete();

        return redirect()->route('pesanan.index')->with('success', 'Data pesanan berhasil dihapus.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_cucian' => 'required|string|max:255',
            'status_pembayaran' => 'required|string|max:20',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update($request->only('status_cucian', 'status_pembayaran'));

        if ($request->status_cucian === 'Selesai') {
        session()->flash('kirim_wa', [
            'nama' => $pesanan->pelanggan->nama,
            'alamat' => $pesanan->pelanggan->alamat,
            'no_hp' => $pesanan->pelanggan->nomor_telepon,
        ]);
    }

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function edit($id) {

        $pesanan = Pesanan::with('pelanggan', 'details.layanan')->findorfail($id);
        $pelanggans = Pelanggan::all();
        $layanans = Layanan::all();

        return view('pesanan.editPesanan', compact('pesanan', 'pelanggans', 'layanans'));

    }

    public function update(Request $request, $id)
    {
        
        setlocale(LC_TIME, 'id_ID.utf8');
        Carbon::setLocale('id');

        // Format and parse the dates
        $tanggal_terima = Carbon::parse($request->tanggal_terima);
        $tanggal_selesai = Carbon::parse($request->tanggal_selesai);
        
        // Merge dates back to the request for validation
        $request->merge([
            'tanggal_terima' => $tanggal_terima,
            'tanggal_selesai' => $tanggal_selesai,
        ]);

        // Validate the request
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'layanan_id.*' => 'required|exists:layanans,id',
            'jenis_barang.*' => 'required|string|max:255',
            'spesifikasi_barang.*' => 'nullable|string|max:255',
            'jumlah.*' => 'required|integer|min:1',
            'harga_satuan.*' => 'required|integer|min:0',
            'status_pembayaran' => 'required|string', 
            'tanggal_terima' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_terima',
            'status_cucian' => 'required|string',
        ]);

        // Find the pesanan record
        $pesanan = Pesanan::findOrFail($id);
        
        // Update the pesanan record
        $pesanan->update([
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal_terima' => $tanggal_terima,
            'tanggal_selesai' => $tanggal_selesai,
            'status_cucian' => $request->status_cucian,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        // Delete existing detail records
        PesananDetail::where('pesanan_id', $id)->delete();

        // Create new pesanan detail records
        foreach ($request->layanan_id as $i => $layanan_id) {
            PesananDetail::create([
                'pesanan_id' => $pesanan->id,
                'layanan_id' => $layanan_id,
                'jenis_barang' => $request->jenis_barang[$i],
                'spesifikasi_barang' => $request->spesifikasi_barang[$i] ?? '',
                'jumlah' => $request->jumlah[$i],
                'harga_satuan' => $request->harga_satuan[$i],
                'total_harga' => $request->jumlah[$i] * $request->harga_satuan[$i],
            ]);
        }

        if ($request->status_cucian === 'Selesai') {
            session()->flash('kirim_wa', [
                'nama' => $pesanan->pelanggan->nama,
                'alamat' => $pesanan->pelanggan->alamat,
                'no_hp' => $pesanan->pelanggan->nomor_telepon,
            ]);
        }

        // Redirect with a success message
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function printNota($id)
    {
        $pesanan = Pesanan::with(['pelanggan', 'details.layanan'])->findOrFail($id);
        return view('pesanan.nota-print', compact('pesanan'));
    }

    public function filter(Request $request)
    {
        $query = Pesanan::with(['pelanggan', 'details.layanan']);

        $tahunList = Pesanan::selectRaw('YEAR(tanggal_terima) as tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        if ($tahunList->isEmpty()) {
            $tahunList = collect([date('Y')]);
        }    

        // Filter by kategori if provided
        if ($request->filled('kategori')) {
            $query->whereHas('details.layanan', function ($q) use ($request) {
                $q->where('kategori', $request->kategori);
            });
        }

        // Filter by tanggal terima (day, month, year)
        if ($request->filled('tanggal_hari') || $request->filled('tanggal_bulan') || $request->filled('tanggal_tahun')) {
            $query->where(function ($q) use ($request) {
                // If day is provided
                if ($request->filled('tanggal_hari')) {
                    $q->whereDay('tanggal_terima', $request->tanggal_hari);
                }
                
                // If month is provided
                if ($request->filled('tanggal_bulan')) {
                    $q->whereMonth('tanggal_terima', $request->tanggal_bulan);
                }
                
                // If year is provided
                if ($request->filled('tanggal_tahun')) {
                    $q->whereYear('tanggal_terima', $request->tanggal_tahun);
                }
            });
        }

        // Filter by status pembayaran if provided
        if ($request->filled('status_pembayaran')) {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }

        // Filter by status cucian if provided
        if ($request->filled('status_cucian')) {
            $query->where('status_cucian', $request->status_cucian);
        }

        // Add request parameter to indicate filtering is active
        $request->merge(['filter' => true]);

        $pesanans = $query->latest()->paginate(10);
        return view('dataPesanan', compact('pesanans', 'tahunList'));
    }

    public function export(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        
        $fileName = 'data_pesanan';
        
        if ($bulan && $tahun) {
            $namaBulan = [
                '1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April',
                '5' => 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus',
                '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
            ];
            $fileName .= '_' . $namaBulan[$bulan] . '_' . $tahun;
        } elseif ($bulan) {
            $namaBulan = [
                '1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April',
                '5' => 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus',
                '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
            ];
            $fileName .= '_' . $namaBulan[$bulan];
        } elseif ($tahun) {
            $fileName .= '_' . $tahun;
        }
        
        $fileName .= '.xlsx';
        
        return Excel::download(new PesananExport($bulan, $tahun), $fileName);
    }

}
