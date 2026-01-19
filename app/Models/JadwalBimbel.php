<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalBimbel extends Model
{
    protected $table = 'jadwal_bimbel';

    protected $fillable = [
        'paket_siswa_id',
        'jadwal_mengajar_id',
        'tanggal',
        'status'
    ];

    public function paketSiswa()
    {
        return $this->belongsTo(PaketSiswa::class);
    }

    public function jadwalMengajar()
    {
        return $this->belongsTo(JadwalMengajar::class);
    }
}
