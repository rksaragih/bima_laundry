<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananSatuan extends Model
{
    
    use HasFactory;

    protected $table = 'pesanan_satuans';

    protected $fillable = [
        'id',
        'jumlah_pakaian',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id');
    }

}
