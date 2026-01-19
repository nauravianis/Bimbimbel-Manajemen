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
Schema::create('jadwal_bimbel', function (Blueprint $table) {
    $table->id();

    $table->foreignId('paket_siswa_id')->constrained('paket_siswa');
    $table->foreignId('jadwal_mengajar_id')->constrained('jadwal_mengajar');

    $table->date('tanggal');
    $table->enum('status', ['Terjadwal','Selesai','Batal'])
          ->default('Terjadwal');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_bimbel');
    }
};
