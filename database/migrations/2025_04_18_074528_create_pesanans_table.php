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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_pelanggan')->constrained('pelanggans')->onDelete('cascade');
            $table->foreignId('id_layanan')->constrained('layanans')->onDelete('cascade');
            $table->string('jenis_barang');
            $table->text('spesifikasi_barang');
            $table->string('tipe_pesanan');
            $table->string('status_cucian');
            $table->string('status_pembayaran');
            $table->integer('total_harga');
            $table->date('tanggal_terima');
            $table->date('tanggal_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
