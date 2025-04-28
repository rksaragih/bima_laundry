<?php

namespace App\Http\Controllers;
use App\Models\Pesanan;
use App\Models\PesananKiloan;
use App\Models\PesananSatuan;
use App\Models\Pelanggan;
use App\Models\Layanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with(['pelanggan', 'layanan', 'kiloan', 'satuan'])->orderBy('created_at', 'desc')->paginate(10);
        return view('dataPesanan', compact('pesanans'));
    }

    public function detail(Request $request, $id)
    {
        $pesanan = Pesanan::with('pelanggan', 'layanan')->findorfail($id);
        $kiloan = null;
        $satuan = null;

        if ( $pesanan->tipe_pesanan === 'kiloan' ) {
            $kiloan = PesananKiloan::where('id', $pesanan->id)->first();
        } elseif ( $pesanan->tipe_pesanan === 'satuan' ) {
            $satuan = PesananSatuan::where('id', $pesanan->id)->first();
        }

        return view('pesanan.detailPesanan', compact('pesanan', 'kiloan', 'satuan'));
    }

    public function create(Request $request)
    {
        $tipe = $request->query('tipe');
        $pelanggans = Pelanggan::all();
        $layanans = Layanan::all();
        return view('pesanan.tambahPesanan', compact('pelanggans', 'layanans', 'tipe' ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_layanan' => 'required|exists:layanans,id',
            'jenis_barang' => 'required|string|max:255',
            'spesifikasi_barang' => 'required|string|max:255',
            'tipe_pesanan' => 'required|in:kiloan,satuan',
            'tanggal_terima' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_terima',
        ]);

        $pesanan = Pesanan::create([
            'id_user' => Auth::id(),
            'id_pelanggan' => $request->id_pelanggan,
            'id_layanan' => $request->id_layanan,
            'jenis_barang' => $request->jenis_barang,
            'spesifikasi_barang' => $request->spesifikasi_barang,
            'tipe_pesanan' => $request->tipe_pesanan,
            'status_cucian' => 'Belum Dicuci',
            'status_pembayaran' => $request->status_pembayaran,
            'total_harga' => $request->total_harga,
            'tanggal_terima' => $request->tanggal_terima,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        if ($request->tipe_pesanan == 'kiloan') {
            PesananKiloan::create([
                'id' => $pesanan->id,
                'berat_pakaian' => $request->berat_pakaian ?? 0,
            ]);

        } else if ($request->tipe_pesanan == 'satuan') {
            PesananSatuan::create([
                'id' => $pesanan->id,
                'jumlah_pakaian' => $request->jumlah_pakaian ?? 0,
            ]);

        }

        return redirect()->route('pesanan.index')->with('success', 'Data pesanan berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $pesanan->delete();
        PesananKiloan::where('id', $id)->delete();
        PesananSatuan::where('id', $id)->delete();

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

        $pesanan = Pesanan::with('pelanggan', 'layanan')->findorfail($id);
        $pelanggans = Pelanggan::all();
        $layanans = Layanan::all();
        $kiloan = null;
        $satuan = null;

        if ( $pesanan->tipe_pesanan === 'kiloan' ) {
            $kiloan = PesananKiloan::where('id', $pesanan->id)->first();
        } elseif ( $pesanan->tipe_pesanan === 'satuan' ) {
            $satuan = PesananSatuan::where('id', $pesanan->id)->first();
        }

        return view('pesanan.editPesanan', compact('pesanan', 'pelanggans', 'layanans', 'kiloan', 'satuan'));

    }

    public function update(Request $request, $id)
    {
    // Validasi input dasar untuk semua tipe pesanan
    $validator = Validator::make($request->all(), [
        'id_pelanggan' => 'required|exists:pelanggans,id',
        'id_layanan' => 'required|exists:layanans,id',
        'spesifikasi_barang' => 'required|string|max:255',
        'jenis_barang' => 'required|string|max:255',
        'tanggal_terima' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_terima',
        'total_harga' => 'required|numeric|min:0',
        'status_cucian' => 'required|in:Belum Dicuci,Dalam Proses,Selesai',
        'status_pembayaran' => 'required|in:Belum Lunas,Lunas',
        'tipe_pesanan' => 'required|in:kiloan,satuan',
    ]);

    if ($validator->fails()) {
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Ambil data pesanan yang akan diupdate
    $pesanan = Pesanan::findOrFail($id);
    $oldTipePesanan = $pesanan->tipe_pesanan;
    $newTipePesanan = $request->tipe_pesanan;

    // Update data pesanan dasar
    $pesanan->id_pelanggan = $request->id_pelanggan;
    $pesanan->id_layanan = $request->id_layanan;
    $pesanan->spesifikasi_barang = $request->spesifikasi_barang;
    $pesanan->jenis_barang = $request->jenis_barang;
    $pesanan->tanggal_terima = $request->tanggal_terima;
    $pesanan->tanggal_selesai = $request->tanggal_selesai;
    $pesanan->total_harga = $request->total_harga;
    $pesanan->status_cucian = $request->status_cucian;
    $pesanan->status_pembayaran = $request->status_pembayaran;
    $pesanan->tipe_pesanan = $request->tipe_pesanan;
    
    // Simpan perubahan dasar
    $pesanan->save();

    // Jika tipe pesanan diganti, hapus data lama dan buat data baru
    if ($oldTipePesanan !== $newTipePesanan) {
        // Hapus data lama
        if ($oldTipePesanan === 'kiloan') {
            PesananKiloan::where('id', $id)->delete();
        } elseif ($oldTipePesanan === 'satuan') {
            PesananSatuan::where('id', $id)->delete();
        }
        
        // Buat data baru sesuai tipe pesanan yang baru
        if ($newTipePesanan === 'kiloan') {
            // Validasi input khusus kiloan
            $validator = Validator::make($request->all(), [
                'berat_pakaian' => 'required|numeric|min:0.01',
            ]);
            
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            // Buat data pesanan kiloan baru
            $pesananKiloan = new PesananKiloan();
            $pesananKiloan->id = $pesanan->id;
            $pesananKiloan->berat_pakaian = $request->berat_pakaian;
            $pesananKiloan->save();
            
        } elseif ($newTipePesanan === 'satuan') {
            // Validasi input khusus satuan
            $validator = Validator::make($request->all(), [
                'jumlah_pakaian' => 'required|numeric|min:1',
            ]);
            
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            // Buat data pesanan satuan baru
            $pesananSatuan = new PesananSatuan();
            $pesananSatuan->id = $pesanan->id;
            $pesananSatuan->jumlah_pakaian = $request->jumlah_pakaian;
            $pesananSatuan->save();
        }

    } else {
        // Tipe pesanan tidak berubah, update data yang sudah ada
        if ($newTipePesanan === 'kiloan') {
            // Validasi input khusus kiloan
            $validator = Validator::make($request->all(), [
                'berat_pakaian' => 'required|numeric|min:0.01',
            ]);
            
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            // Update data pesanan kiloan
            $pesananKiloan = PesananKiloan::where('id', $id)->first();

            if (!$pesananKiloan) {
                $pesananKiloan = new PesananKiloan();
                $pesananKiloan->id = $pesanan->id;
            }

            $pesananKiloan->berat_pakaian = $request->berat_pakaian;
            $pesananKiloan->save();
            
        } elseif ($newTipePesanan === 'satuan') {
            // Validasi input khusus satuan
            $validator = Validator::make($request->all(), [
                'jumlah_pakaian' => 'required|numeric|min:1',
            ]);
            
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            // Update data pesanan satuan
            $pesananSatuan = PesananSatuan::where('id', $id)->first();
            if (!$pesananSatuan) {
                $pesananSatuan = new PesananSatuan();
                $pesananSatuan->id = $pesanan->id;
            }
            $pesananSatuan->jumlah_pakaian = $request->jumlah_pakaian;
            $pesananSatuan->save();
            }
        }

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui.');
    }
}
