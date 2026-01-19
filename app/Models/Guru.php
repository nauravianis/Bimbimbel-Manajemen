<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';

    protected $fillable = [
        'nama',
        'mapel',
        'email',
        'nomor_telp',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'kota',
        'status_aktif',
        'qr_token',
        'tarif_per_jam',
        'created_at'
    ];

    public function absensi()
    {
        return $this->hasMany(AbsensiGuru::class, 'guru_id');
    }
    public function jadwal()
{
    return $this->hasMany(JadwalMengajar::class, 'guru_id');
}
}