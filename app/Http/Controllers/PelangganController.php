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

        $pelanggans = $query->paginate(10);
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

        Pelanggan::create($request->all());

        return redirect()->back()->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->only('nama', 'alamat', 'nomor_telepon'));

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
