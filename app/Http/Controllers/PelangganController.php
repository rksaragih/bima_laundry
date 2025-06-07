<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Exports\PelangganExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{

    public function index(Request $request)
    {

        $query = Pelanggan::query();

        if ($request->filled('alamat')) {
            $query->where('alamat', $request->alamat);
        }

        $pelanggans = $query->latest()->paginate(10);
        $alamatList = Pelanggan::select('alamat')->distinct()->pluck('alamat');
        return view('dataPelanggan', compact('pelanggans', 'alamatList'));

    }

    public function searchByNama(Request $request)
    {

        $query = Pelanggan::query();

        if ($request->filled('alamat')) {
            $query->where('alamat', $request->alamat);
        }

        $pelanggans = Pelanggan::where('nama', 'like', '%' . $request->search_nama . '%')->paginate(10);
        $alamatList = Pelanggan::select('alamat')->distinct()->pluck('alamat');
        return view('dataPelanggan', compact('pelanggans', 'alamatList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
        ]);

        $nomorTelepon = preg_replace('/[^0-9]/', '', $request->nomor_telepon);
        if (strpos($nomorTelepon, '0') === 0) {
            $nomorTelepon = '62' . substr($nomorTelepon, 1);
        }

        Pelanggan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nomor_telepon' => $nomorTelepon,
        ]);

        return redirect()->back()->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
        ]);

        $nomorTelepon = preg_replace('/[^0-9]/', '', $request->nomor_telepon);
        if (strpos($nomorTelepon, '0') === 0) {
            $nomorTelepon = '62' . substr($nomorTelepon, 1);
        }

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nomor_telepon' => $nomorTelepon,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new PelangganExport, 'Data Pelanggan Per ' . now()->format('Ymd_His') . '.xlsx');
    }

}
