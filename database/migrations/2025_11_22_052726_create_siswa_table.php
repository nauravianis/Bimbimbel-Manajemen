<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('siswa', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('sekolah');
    $table->string('no_telp_ortu', 20);
    $table->date('tanggal_lahir')->nullable();
    $table->enum('jk', ['Laki-laki', 'Perempuan'])->nullable();
    $table->text('alamat')->nullable();
    $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
