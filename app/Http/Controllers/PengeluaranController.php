<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    
    public function index()
    {

        if (Auth::user()->role === 'Admin') {

        $pengeluarans = Pengeluaran::orderBy('created_at', 'desc')->paginate(10);
        return view('dataPengeluaran', compact('pengeluarans'));

        } else {

            abort(403, 'Unauthorized');

        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_pengeluaran' => 'required|string|max:255',
            'biaya' => 'required|integer',
            'tanggal' => 'required|date',
        ]);

        Pengeluaran::create([
            'id_user' => Auth::id(),
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'biaya' => $request->biaya,
            'tanggal' => $request->tanggal,
        ]);

        if (Auth::user()->role === 'Admin') {
            return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil ditambahkan.');
        } 

        return redirect()->back()->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_pengeluaran' => 'required|string|max:255',
            'biaya' => 'required|integer',
            'tanggal' => 'required|date',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update($request->only('jenis_pengeluaran', 'biaya', 'tanggal'));

        return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil dihapus.');
    }

}
