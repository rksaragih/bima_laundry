<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layanan extends Model
{

    use HasFactory;

    protected $table = 'layanans';
    protected $fillable = [
        'jenis_layanan', 
        'harga', 
    ];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'id_layanan');
    }

}
