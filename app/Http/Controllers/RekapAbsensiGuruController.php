<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use Carbon\Carbon;

class RekapAbsensiGuruController extends Controller
{

public function index(Request $request)
{
    $bulan = $request->bulan ?? now()->month;
    $tahun = $request->tahun ?? now()->year;

    $guru = Guru::with(['absensi' => function ($q) use ($bulan, $tahun) {
        $q->whereMonth('tanggal', $bulan)
          ->whereYear('tanggal', $tahun);
    }])->get();

    foreach ($guru as $g) {

        $hadirList = $g->absensi->filter(fn($a) => strtolower($a->status) === 'hadir');
        $tidak_hadir  = $g->absensi->filter(fn($a) => strtolower($a->status) === 'tidak_hadir')->count();
        $terlambat = $g->absensi->filter(fn($a) => strtolower($a->status) === 'terlambat')->count();

        // HITUNG TOTAL JAM (ANTI MINUS)
        $totalJam = 0;

        foreach ($hadirList as $a) {
            if ($a->jam_masuk && $a->jam_keluar) {

                $masuk  = Carbon::parse($a->jam_masuk);
                $keluar = Carbon::parse($a->jam_keluar);

                if ($keluar->gt($masuk)) {
                    $totalJam += $masuk->diffInMinutes($keluar) / 60;
                }
            }
        }

        $g->hadir     = $hadirList->count();
        $g->tidak_hadir      = $tidak_hadir;
        $g->terlambat     = $terlambat;
        $g->total_jam = round($totalJam, 1);
    }

    return view('absensi.rekap-guru', compact('guru', 'bulan', 'tahun'));
}
}