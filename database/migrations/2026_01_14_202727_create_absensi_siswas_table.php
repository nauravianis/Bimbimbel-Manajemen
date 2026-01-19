<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('absensi_siswas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('jadwal_mengajar_id')
                ->constrained('jadwal_mengajar')
                ->cascadeOnDelete();

            $table->foreignId('siswa_id')
                ->constrained('siswa')
                ->cascadeOnDelete();

            $table->date('tanggal');

            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alfa'])
                ->default('Hadir');

            $table->timestamps();

            // cegah absen double di hari yg sma
            $table->unique(
                ['jadwal_mengajar_id', 'siswa_id', 'tanggal'],
                'absen_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi_siswas');
    }
};
