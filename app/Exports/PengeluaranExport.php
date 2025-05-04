<?php

namespace App\Exports;

use App\Models\Pengeluaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengeluaranExport implements FromCollection, WithHeadings
{

    protected $bulan;
    protected $tahun;

    public function __construct($bulan = null, $tahun = null)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        $query = Pengeluaran::with('user');

        if ($this->bulan) {
            $query->whereMonth('tanggal', $this->bulan);
        }

        if ($this->tahun) {
            $query->whereYear('tanggal', $this->tahun);
        }

        return $query->get()->map(function ($item) {
            return [
                'jenis_pengeluaran' => $item->jenis_pengeluaran,
                'biaya' => $item->biaya,
                'tanggal' => $item->tanggal,
                'pencatat' => $item->user->role ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return ['Jenis Pengeluaran', 'Biaya', 'Tanggal', 'Dicatat Oleh'];
    }

}
