<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;

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
            'jenis_layanan' => 'required|string|max:255',
            'harga' => 'required|integer',
        ]);

        Layanan::create($request->all());

        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_layanan' => 'required|string|max:255',
            'harga' => 'required|integer',
        ]);

        $layanan = Layanan::findOrFail($id);
        $layanan->update($request->only('jenis_layanan', 'harga'));

        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil dihapus.');
    }

}
