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
        Schema::create('pesanan_kiloans', function (Blueprint $table) {
            $table->id();
            $table->foreign('id')->references('id')->on('pesanans')->onDelete('cascade');
            $table->integer('berat_pakaian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_kiloans');
    }
};
