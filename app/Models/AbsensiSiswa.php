<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiSiswa extends Model
{
    use HasFactory;

    protected $table = 'absensi_siswas';

    protected $fillable = [
        'jadwal_mengajar_id',
        'siswa_id',
        'tanggal',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function jadwalMengajar()
    {
        return $this->belongsTo(JadwalMengajar::class);
    }
}
