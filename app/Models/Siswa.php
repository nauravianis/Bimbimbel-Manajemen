<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\PembayaranSiswa;
use App\Models\Transaksi;
use App\Models\PaketSiswa;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'nama',
        'sekolah',
        'no_telp_ortu',
        'tanggal_lahir',
        'jk',
        'alamat',
        'status',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function paketSiswa()
    {
        return $this->hasMany(PaketSiswa::class);
    }
    public function pembayaran()
{
    return $this->hasMany(PembayaranSiswa::class);
}
public function absensi()
{
    return $this->hasMany(AbsensiSiswa::class);
}


}
