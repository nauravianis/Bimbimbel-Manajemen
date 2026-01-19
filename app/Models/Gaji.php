<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $table = 'gaji';
    protected $fillable = [
        'guru_id', 'nominal', 'jumlah_jam', 
        'total_gaji', 'tanggal', 'bulan', 'tahun', 'keterangan'
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}