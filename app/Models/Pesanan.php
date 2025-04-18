<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';

    protected $fillable = [
        'id_user',
        'id_pelanggan',
        'id_layanan',
        'jenis_barang',
        'spesifikasi_barang',
        'tipe_pesanan',
        'status_cucian',
        'status_pembayaran',
        'total_harga',
        'tanggal_terima',
        'tanggal_selesai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }

    public function kiloan()
    {
        return $this->hasOne(PesananKiloan::class, 'id');
    }

    public function satuan()
    {
        return $this->hasOne(PesananSatuan::class, 'id');
    }

}
