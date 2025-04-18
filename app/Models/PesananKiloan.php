<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
