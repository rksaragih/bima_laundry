<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class PesananExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan = null, $tahun = null)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function array(): array
    {
        $query = Pesanan::with(['pelanggan', 'details.layanan', 'user']);

        if ($this->bulan) {
            $query->whereMonth('tanggal_terima', $this->bulan);
        }

        if ($this->tahun) {
            $query->whereYear('tanggal_terima', $this->tahun);
        }

        $pesanans = $query->latest()->get();
        $rows = [];
        $no = 1;

        foreach ($pesanans as $pesanan) {
            $totalHargaPesanan = $pesanan->details->sum('total_harga');
            
            foreach ($pesanan->details as $index => $detail) {
                $rows[] = [
                    ($index === 0) ? $no : '',
                    ($index === 0) ? $pesanan->pelanggan->nama : '',
                    ($index === 0) ? $pesanan->pelanggan->nomor_telepon : '',
                    $detail->layanan->kategori ?? '-',
                    $detail->jenis_barang,
                    $detail->spesifikasi_barang ?? '-',
                    $detail->jumlah,
                    'Rp ' . number_format($detail->harga_satuan, 0, ',', '.'),
                    'Rp ' . number_format($detail->total_harga, 0, ',', '.'),
                    ($index === 0) ? 'Rp ' . number_format($totalHargaPesanan, 0, ',', '.') : '',
                    ($index === 0) ? $pesanan->status_pembayaran : '',
                    ($index === 0) ? $pesanan->status_cucian : '',
                    ($index === 0) ? Carbon::parse($pesanan->tanggal_terima)->format('d M Y') : '',
                    ($index === 0) ? Carbon::parse($pesanan->tanggal_selesai)->format('d M Y') : '',
                    ($index === 0) ? $pesanan->user->name ?? $pesanan->user->role : ''
                ];
            }
            
            $no++;
        }
        
        return $rows;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Pelanggan',
            'Nomor Telepon',
            'Kategori Layanan',
            'Jenis Barang',
            'Spesifikasi',
            'Jumlah',
            'Harga Satuan',
            'Total Harga Item',
            'Total Harga Pesanan',
            'Status Pembayaran',
            'Status Cucian',
            'Tanggal Terima',
            'Estimasi Selesai',
            'Petugas'
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}