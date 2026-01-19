<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'kode_pembayaran',
        'siswa_id',
        'paket_bimbel_id',
        'tanggal_transaksi',
        'total',
        'metode',
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

    public function paketSiswa()
    {
        return $this->hasOne(PaketSiswa::class);
    }
}

