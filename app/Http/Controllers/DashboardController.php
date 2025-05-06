<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pesanan;
use App\Models\Pengeluaran;

class DashboardController extends Controller
{

    public function getGrafik(Request $request)
    {
        $tahun = $request->tahun ?? now()->year;
    
        // Pendapatan
        $dataPendapatan = DB::table('pesanan_details')
            ->join('pesanans', 'pesanan_details.pesanan_id', '=', 'pesanans.id')
            ->selectRaw('MONTH(pesanans.tanggal_terima) as bulan, SUM(pesanan_details.total_harga) as total')
            ->whereYear('pesanans.tanggal_terima', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
    
        $pendapatanPerBulan = array_fill(1, 12, 0);
        foreach ($dataPendapatan as $item) {
            $pendapatanPerBulan[$item->bulan] = $item->total;
        }
    
        // Pengeluaran
        $dataPengeluaran = DB::table('pengeluarans')
            ->selectRaw('MONTH(tanggal) as bulan, SUM(biaya) as total')
            ->whereYear('tanggal', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
    
        $pengeluaranPerBulan = array_fill(1, 12, 0);
        foreach ($dataPengeluaran as $item) {
            $pengeluaranPerBulan[$item->bulan] = $item->total;
        }
    
        // Hitung keuntungan per bulan
        $keuntunganPerBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $keuntunganPerBulan[$i] = $pendapatanPerBulan[$i] - $pengeluaranPerBulan[$i];
        }
    
        // Hitung total untuk satu tahun
        $totalPendapatan = array_sum($pendapatanPerBulan);
        $totalPengeluaran = array_sum($pengeluaranPerBulan);
        $totalKeuntungan = $totalPendapatan - $totalPengeluaran;
    
        // Tahun tersedia
        $tahunList = DB::table('pesanans')
            ->selectRaw('YEAR(tanggal_terima) as tahun')
            ->distinct()
            ->pluck('tahun');
    
        return view('index', [
            'pendapatan' => $pendapatanPerBulan,
            'pengeluaran' => $pengeluaranPerBulan,
            'keuntungan' => $keuntunganPerBulan,
            'totalPendapatan' => $totalPendapatan,
            'totalPengeluaran' => $totalPengeluaran,
            'totalKeuntungan' => $totalKeuntungan,
            'tahunList' => $tahunList,
            'selectedTahun' => $tahun,
        ]);
    }
    
}
