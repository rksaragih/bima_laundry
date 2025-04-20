<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    
    public function index()
    {
        $pelanggans = Pelanggan::orderBy('created_at', 'desc')->paginate(10);
        return view('dataPelanggan', compact('pelanggans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan.');
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

}
