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
    Schema::table('gaji', function (Blueprint $table) {
        $table->string('bulan', 20)->after('tanggal'); 
        $table->year('tahun')->after('bulan');    
        $table->integer('jumlah_jam')->after('nominal'); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gaji', function (Blueprint $table) {
            //
        });
    }
};
