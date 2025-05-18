<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hero_proses')->insert([
            [
                'hero_title' => 'Bima Laundry',
                'hero_subtitle' => 'Laundry Terbaik di Cibinong',
                'hero_description' => 'Kami siap membantu Anda dengan berbagai layanan laundry berkualitas di daerah Cibinong, Bogor.',
                'hero_cta_link' => '#layanan',
                'hero_cta_text' => 'Lihat Layanan Kami',
                'hero_image' => 'images/laundry-hero.png',
            ],
        ]);
    }
}
