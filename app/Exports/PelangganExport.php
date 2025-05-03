<?php

namespace App\Exports;

use App\Models\Pelanggan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PelangganExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pelanggan::all()->map(function ($item) {
            return [
                'nama' => $item->nama,
                'nomor_telepon' => $item->nomor_telepon,
                'alamat' => $item->alamat,
                'tanggal_dibuat' => $item->created_at->format('Y-m-d'),
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama Pelanggan', 'Nomor Telepon', 'Alamat', 'Tanggal Di Input'];
    }
}
