<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JadwalMengajar;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapel';

    protected $fillable = [
        'nama_mapel'
    ];

    public function jadwal()
    {
        return $this->hasMany(JadwalMengajar::class, 'mapel_id');
    }
}
