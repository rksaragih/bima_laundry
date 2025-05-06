<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LayananPengirimanController extends Controller
{
    // Tampilkan halaman peta
    public function showMap()
    {
        return view('map');
    }

    // Ambil data GeoJSON
    public function getGeojson()
    {
        $path = public_path('geojson/lahan.geojson');

        if (!File::exists($path)) {
            return response()->json(['error' => 'GeoJSON file not found'], 404);
        }

        $geojson = File::get($path);

        return response($geojson, 200)
            ->header('Content-Type', 'application/json');
    
    }

    public function index()
    {
        // tampilkan view halaman layanan pengiriman
        return view('layananpengiriman.index');
    }


}
