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
        Schema::create('absensi_guru', function (Blueprint $table) {
    $table->id();

    $table->foreignId('guru_id')
          ->constrained('guru')
          ->cascadeOnDelete();
          
    $table->date('tanggal');

    $table->time('jam_masuk')->nullable();
    $table->time('jam_keluar')->nullable();

    $table->enum('status', ['hadir','terlambat','tidak_hadir'])
          ->default('hadir');

    $table->boolean('status_bayar')->default(false);

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
