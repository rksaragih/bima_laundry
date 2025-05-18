<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeroProsesTable extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel hero_proses.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('hero_proses', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_cta_link')->nullable();
            $table->string('hero_cta_text')->nullable();
            $table->string('hero_image')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations (menghapus tabel).
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_proses');
    }
}
