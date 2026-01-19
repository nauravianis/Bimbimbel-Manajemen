<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\AbsensiGuru;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahSiswa    = Siswa::count();
        $jumlahPengajar = Guru::count();
        $jumlahMapel    = Mapel::count();

        $absen = AbsensiGuru::orderBy('tanggal', 'desc')
                    ->limit(10)
                    ->get();

        return view('dashboard.index', compact(
            'jumlahSiswa',
            'jumlahPengajar',
            'jumlahMapel',
            'absen'
        ));
    }
}
