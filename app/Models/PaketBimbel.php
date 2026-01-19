<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketBimbel extends Model
{
    public function create()
{
    return view('Jadwal.create', [
        'mapel'       => Mapel::all(),
        'guru'        => Guru::all(),
        'paketBimbel' => PaketBimbel::all(),
    ]);
}

    protected $table = 'paket_bimbel';

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function paketSiswa()
    {
        return $this->hasMany(PaketSiswa::class);
    }
}
