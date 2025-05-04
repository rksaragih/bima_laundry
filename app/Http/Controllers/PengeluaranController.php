<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use App\Models\User;
use App\Exports\PengeluaranExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{

    
    public function index(Request $request)
    {

        if (Auth::user()->role === 'Admin') {


        $query = Pengeluaran::with('user');

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }
    
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        if ($request->filled('pencatat')) {
            $query->where('id_user', $request->pencatat);
        }

        $pengeluarans = $query->paginate(10);

        $pencatatList = User::whereIn('id', Pengeluaran::select('id_user'))->get();

        $tahunList = Pengeluaran::selectRaw('YEAR(tanggal) as tahun')->distinct()->pluck('tahun');

        return view('dataPengeluaran', compact('pengeluarans', 'pencatatList', 'tahunList'));

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

    public function export(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');
    
        return Excel::download(new PengeluaranExport($bulan, $tahun), 'pengeluaran_' . now()->format('Ymd_His') . '.xlsx');
    }

}
