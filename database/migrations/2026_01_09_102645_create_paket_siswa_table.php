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
Schema::create('paket_siswa', function (Blueprint $table) {
    $table->id();

    $table->foreignId('siswa_id')->constrained('siswa');
    $table->foreignId('paket_bimbel_id')->constrained('paket_bimbel');
    $table->foreignId('transaksi_id')->constrained('transaksi');

    $table->integer('sisa_pertemuan');
    $table->enum('status', ['Aktif','Selesai'])->default('Aktif');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_siswa');
    }
};
