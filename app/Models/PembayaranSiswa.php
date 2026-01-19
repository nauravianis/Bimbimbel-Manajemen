<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranSiswa extends Model
{
    protected $table = 'pembayaran_siswa';

    protected $fillable = [
        'siswa_id',
        'paket_id',
        'nominal',
        'tanggal',
        'metode'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
