<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Proses;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function show()
    {
        // Ambil data hero dari database
        $heroProsesData = \App\Models\HeroProses::first();

        // Ambil data untuk hero section
        $hero = new \stdClass();
        $hero->title = $heroProsesData->hero_title ?? 'Default Hero Title';
        $hero->subtitle = $heroProsesData->hero_subtitle ?? 'Default Hero Subtitle';
        $hero->description = $heroProsesData->hero_description ?? 'Default Hero Description';
        $hero->cta_link = $heroProsesData->hero_cta_link ?? '#'; 
        $hero->cta_text = $heroProsesData->hero_cta_text ?? 'Learn More';
        $hero->image_path = asset('storage/' . ($heroProsesData->hero_image ?? 'default-image.png'));

        $proses = Proses::all();

        if ($heroProsesData->hero_image) {
            $hero->image_url = Storage::url($heroProsesData->hero_image);
        } else {
            $hero->image_url = asset('default-image.png');
        }

        $layanan = Layanan::all();

        return view('company-profile', compact('hero', 'proses', 'layanan'));
    }
}
