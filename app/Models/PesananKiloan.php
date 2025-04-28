<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesananKiloan extends Model
{
    
    use HasFactory;

    protected $table = 'pesanan_kiloans';

    protected $fillable = [
        'id',
        'berat_pakaian',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id');
    }
    
}
