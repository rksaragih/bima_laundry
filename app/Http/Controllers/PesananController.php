<?php

namespace App\Http\Controllers;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Pelanggan;
use App\Models\Layanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PesananController extends Controller
{
    
    public function index() {
        $pesanans = Pesanan::with(['pelanggan', 'details.layanan'])->latest()->paginate(10);
        return view('dataPesanan', compact('pesanans'));
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

        // Redirect with a success message
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

}
