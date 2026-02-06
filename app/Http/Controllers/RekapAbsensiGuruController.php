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

        // NORMALISASI STATUS (lowercase)
        $hadirList = $g->absensi->filter(fn($a) => strtolower($a->status) === 'hadir');
        $izin  = $g->absensi->filter(fn($a) => strtolower($a->status) === 'izin')->count();
        $sakit = $g->absensi->filter(fn($a) => strtolower($a->status) === 'sakit')->count();
        $alpha = $g->absensi->filter(fn($a) => strtolower($a->status) === 'alpha')->count();

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
        $g->izin      = $izin;
        $g->sakit     = $sakit;
        $g->alpha     = $alpha;
        $g->total_jam = round($totalJam, 1);
    }

    return view('absensi.rekap-guru', compact('guru', 'bulan', 'tahun'));
}
}