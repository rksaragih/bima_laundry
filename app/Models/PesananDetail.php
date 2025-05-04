<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesananDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id',
        'layanan_id',
        'jenis_barang',
        'spesifikasi_barang',
        'jumlah',
        'harga_satuan',
        'total_harga',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}
