<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';

    protected $fillable = [
        'user_id',
        'pelanggan_id',
        'status_cucian',
        'status_pembayaran',
        'tanggal_terima',
        'tanggal_selesai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function details()
    {
        return $this->hasMany(PesananDetail::class);
    }

    public function getTotalHargaAttribute()
    {
        return $this->details->sum('total_harga');
    }

}
