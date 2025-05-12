<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroProses extends Model
{
    use HasFactory;

    protected $table = 'hero_proses';

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_description',
        'hero_cta_link',
        'hero_cta_text',
        'hero_image',
    ];
}
