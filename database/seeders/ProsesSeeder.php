<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProsesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proses')->insert([
            [
                'title' => 'Order',
                'subtitle' => 'Laundry Terbaik di Cibinong',
                'description' => 'Silakan order ke kami secara online maupun offline',
                'image' => 'images/order.svg',
            ],
            [
                'title' => 'We Clean',
                'subtitle' => 'Laundry Terbaik di Cibinong',
                'description' => 'Kami membersihkan baju Anda dengan maksimal',
                'image' => 'images/weClean.svg',
            ],
            [
                'title' => 'We Return',
                'subtitle' => 'Laundry Terbaik di Cibinong',
                'description' => 'Kami mengembalikan baju Anda',
                'image' => 'images/weReturn.svg',
            ],
        ]);
    }
}
