<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\AbsensiGuru;
use App\Models\Gaji;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class GajiController extends Controller
{
public function index()
{
    $data_guru = Guru::select('guru.*')
        ->selectRaw('
            SUM(
                CEILING(
                    TIMESTAMPDIFF(MINUTE, absensi_guru.jam_masuk, absensi_guru.jam_keluar) / 60
                )
            ) as total_hadir_belum_bayar
        ')
        ->leftJoin('absensi_guru', function ($join) {
            $join->on('guru.id', '=', 'absensi_guru.guru_id')
                 ->where('absensi_guru.status', 'hadir')
                 ->where('absensi_guru.status_bayar', false)
                 ->whereNotNull('absensi_guru.jam_keluar');
        })
        ->groupBy('guru.id')
        ->orderBy('guru.nama')
        ->get();

    return view('gaji.index', compact('data_guru'));
}

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:guru,id',
        ]);

        $guru = Guru::findOrFail($request->guru_id);

        // Ambil absensi yang blm dibayar
        $absensi = AbsensiGuru::where('guru_id', $guru->id)
            ->where('status', 'hadir')
            ->where('status_bayar', false)
            ->whereNotNull('jam_masuk')
            ->whereNotNull('jam_keluar')
            ->get();

        if ($absensi->isEmpty()) {
            return back()->with('error', 'Tidak ada jam mengajar yang bisa dibayar.');
        }

        $totalJam = 0;

        foreach ($absensi as $item) {
            $masuk  = Carbon::parse($item->jam_masuk);
            $keluar = Carbon::parse($item->jam_keluar);

            $menit = $masuk->diffInMinutes($keluar);

            $jam = ceil($menit / 60);

            $totalJam += $jam;
        }

        $tarifPerJam = $guru->tarif_per_jam;
        $totalGaji   = $totalJam * $tarifPerJam;

        DB::transaction(function () use (
            $guru,
            $tarifPerJam,
            $totalJam,
            $totalGaji,
            $absensi,
            &$gaji
        ) {
            $gaji = Gaji::create([
                'guru_id'    => $guru->id,
                'bulan'      => now()->translatedFormat('F'),
                'tahun'      => now()->year,
                'nominal'    => $tarifPerJam, 
                'jumlah_jam' => $totalJam,
                'total_gaji' => $totalGaji,
                'tanggal'    => now(),
            ]);
            AbsensiGuru::whereIn('id', $absensi->pluck('id'))
                ->update(['status_bayar' => true]);
        });

        return redirect()
            ->route('gaji.show', $gaji->id)
            ->with('success', 'Gaji guru berhasil dibayarkan.');
    }

    /**
     * Slip gaji
     */
    public function show($id)
    {
        $gaji = Gaji::with('guru')->findOrFail($id);
        return view('gaji.slip', compact('gaji'));
    }
}
