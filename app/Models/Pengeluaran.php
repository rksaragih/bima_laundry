<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    
    use HasFactory;

    protected $table = 'pengeluarans';
    protected $fillable = [
        'id_user', 
        'jenis_pengeluaran',
        'biaya',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
