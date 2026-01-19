<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketSiswa extends Model
{
    protected $table = 'paket_siswa';

    protected $fillable = [
        'siswa_id',
        'paket_bimbel_id',
        'transaksi_id',
        'sisa_pertemuan',
        'status'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function paket()
    {
        return $this->belongsTo(PaketBimbel::class, 'paket_bimbel_id');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function jadwalBimbel()
    {
        return $this->hasMany(JadwalBimbel::class);
    }
}
