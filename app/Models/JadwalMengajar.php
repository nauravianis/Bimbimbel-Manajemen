<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalMengajar extends Model
{
    use HasFactory;

    protected $table = 'jadwal_mengajar';

protected $fillable = [
    'guru_id',
    'paket_bimbel_id',
    'mapel_id',
    'hari',
    'jam_mulai',
    'jam_selesai',
];



    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
    public function jadwalBimbel()
    {
        return $this->hasMany(JadwalBimbel::class);
    }

public function paketBimbel()
{
    return $this->belongsTo(PaketBimbel::class);
}
public function absensiSiswa()
{
    return $this->hasMany(AbsensiSiswa::class);
}



}
