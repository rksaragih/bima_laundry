<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Model
{

    use HasFactory;

    protected $table = 'pelanggans';
    protected $fillable = [
        'nama', 
        'alamat',
        'nomor_telepon', 
    ];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'id_pelanggan');
    }

}
