<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanan_satuans', function (Blueprint $table) {
            $table->id();
            $table->foreign('id')->references('id')->on('pesanans')->onDelete('cascade');
            $table->integer('jumlah_pakaian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_satuans');
    }
};
