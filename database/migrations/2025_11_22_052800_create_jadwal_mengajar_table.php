<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('jadwal_mengajar', function (Blueprint $table) {
        $table->id();
        $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');
        $table->foreignId('mapel_id')->constrained('mapel')->onDelete('cascade');
        $table->foreignId('paket_bimbel_id')->constrained('paket_bimbel')->onDelete('cascade');
        $table->string('hari');
        $table->time('jam_mulai');
        $table->time('jam_selesai');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_mengajar');
    }
};
