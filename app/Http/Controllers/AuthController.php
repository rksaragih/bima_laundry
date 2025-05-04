<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function loginForm() {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'Admin') {
                return redirect()->route('index');
            } elseif (Auth::user()->role === 'Kasir') {
                return redirect()->route('pesanan.index');
            } else{
                return view('login');
            }
    
        }

        return back()->withErrors([
            'login' => 'Username atau password salah!',
        ]);
    }

    public function logout(Request $request)
    {
        
        \Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/loginPage')->with('message', 'Anda berhasil logout');;
    }

    public function getGrafikPendapatan(Request $request)
    {
        $tahun = $request->tahun ?? now()->year;

        $data = DB::table('pesanan_details')
            ->join('pesanans', 'pesanan_details.pesanan_id', '=', 'pesanans.id')
            ->selectRaw('MONTH(pesanans.tanggal_terima) as bulan, SUM(pesanan_details.total_harga) as total')
            ->whereYear('pesanans.tanggal_terima', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $pendapatanPerBulan = array_fill(1, 12, 0);
        foreach ($data as $item) {
            $pendapatanPerBulan[$item->bulan] = $item->total;
        }

        $tahunList = DB::table('pesanans')
            ->selectRaw('YEAR(tanggal_terima) as tahun')
            ->distinct()
            ->pluck('tahun');

        return view('index', [
            'pendapatan' => $pendapatanPerBulan,
            'tahunList' => $tahunList,
            'selectedTahun' => $tahun,
        ]);
    }

}
