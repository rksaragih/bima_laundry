<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use Illuminate\Support\Facades\Auth;

class LayananController extends Controller
{
    
    public function index()
    {
        $layanans = Layanan::all();
        return view('dataLayanan', compact('layanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_laundry' => 'required|string|max:255',
            'harga' => 'nullable|integer',
            'kategori' => 'required|string|max:255'
        ]);

        Layanan::create($request->all());

        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_laundry' => 'required|string|max:255',
            'harga' => 'nullable|integer',
            'kategori' => 'required|string|max:255',
        ]);

        $layanan = Layanan::findOrFail($id);
        $layanan->update($request->only('jenis_laundry', 'harga', 'kategori'));

        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil dihapus.');
    }

}
