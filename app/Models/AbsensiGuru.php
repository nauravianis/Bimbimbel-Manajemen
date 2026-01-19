<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiGuru extends Model
{
    protected $table = 'absensi_guru';

protected $fillable = [
    'guru_id',
    'jadwal_id',
    'tanggal',
    'jam_masuk',
    'jam_keluar',
    'status',
    'status_bayar'
];


    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function jadwalMengajar()
    {
        return $this->belongsTo(JadwalMengajar::class, 'jadwal_id');
    }
}

