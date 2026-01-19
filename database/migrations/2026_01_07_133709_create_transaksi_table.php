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
Schema::create('transaksi', function (Blueprint $table) {
    $table->id();
    $table->string('kode_pembayaran');
    $table->foreignId('siswa_id')->constrained('siswa');
    $table->foreignId('paket_bimbel_id')->constrained('paket_bimbel');
    $table->date('tanggal_transaksi');
    $table->integer('total');
    $table->enum('metode', ['Cash','Transfer']);
    $table->enum('status', ['Lunas','Belum Lunas'])->default('Lunas');
    $table->timestamps();
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
