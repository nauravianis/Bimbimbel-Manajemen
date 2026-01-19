<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukan';

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'jumlah',
        'keterangan'
    ];
}
