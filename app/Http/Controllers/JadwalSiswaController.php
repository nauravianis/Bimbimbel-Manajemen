<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\JadwalMengajar;
use App\Models\PaketSiswa;
use App\Models\AbsensiSiswa;
use App\Models\PaketBimbel;
use App\Models\JadwalBimbel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalSiswaController extends Controller
{

    public function index($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);

        $pertemuan = JadwalBimbel::with('jadwalMengajar.mapel')
            ->whereHas('paketSiswa', function ($q) use ($siswa_id) {
                $q->where('siswa_id', $siswa_id)
                ->where('status', 'aktif');
            })
            ->orderBy('tanggal')
            ->get();

        return view('jadwal.siswa', compact('siswa', 'pertemuan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $jadwal = JadwalBimbel::with('paketSiswa.siswa')->findOrFail($id);

        if ($jadwal->status !== 'Terjadwal') {
            return back()->with('error', 'Pertemuan sudah diselesaikan.');
        }

        DB::transaction(function () use ($jadwal) {

            $jadwal->update([
                'status' => 'Selesai'
            ]);

            $paket = $jadwal->paketSiswa;
            $paket->decrement('sisa_pertemuan');

            if ($paket->refresh()->sisa_pertemuan <= 0) {
                $paket->update(['status' => 'habis']);
                $paket->siswa->update(['status' => 'Nonaktif']);
            }
        });

        return back()->with('success', 'Absensi berhasil. Kuota berkurang.');
    }
    public function showAbsenKelas($id)
    {
        $jadwal = JadwalMengajar::with(['mapel', 'paketBimbel'])
            ->findOrFail($id);


        $siswa = Siswa::whereHas('paketSiswa', function ($query) use ($jadwal) {
            $query->where('paket_bimbel_id', $jadwal->paket_bimbel_id)
                ->where('status', 'Aktif');
        })->with('paketSiswa')->get();

        return view('jadwal.absen_kelas', compact('jadwal', 'siswa'));
    }
    public function simpanAbsenMasal(Request $request)
    {
        $request->validate([
            'jadwal_mengajar_id' => 'required',
            'tanggal' => 'required|date',
            'siswa_id' => 'required|array',
            'absen' => 'required|array',
        ]);

        $sudahAbsen = AbsensiSiswa::where('jadwal_mengajar_id', $request->jadwal_mengajar_id)
            ->where('tanggal', $request->tanggal)
            ->exists();

        if ($sudahAbsen) {
            return back()->with('error', 'Absensi untuk jadwal ini sudah dilakukan hari ini.');
        }

        DB::beginTransaction();

        try {
            $jadwal = JadwalMengajar::findOrFail($request->jadwal_mengajar_id);

            foreach ($request->siswa_id as $siswa_id) {
                $statusAbsen = $request->absen[$siswa_id] ?? 'Alfa';

                AbsensiSiswa::create([
                    'jadwal_mengajar_id' => $request->jadwal_mengajar_id,
                    'siswa_id' => $siswa_id,
                    'tanggal' => $request->tanggal,
                    'status' => $statusAbsen
                ]);

                $paketSiswa = PaketSiswa::where('siswa_id', $siswa_id)
                    ->where('paket_bimbel_id', $jadwal->paket_bimbel_id)
                    ->where('status', 'Aktif')
                    ->first();

                if ($paketSiswa && $paketSiswa->sisa_pertemuan > 0) {
                    $paketSiswa->decrement('sisa_pertemuan');

                    $paketSiswa->refresh();

                    if ($paketSiswa->sisa_pertemuan <= 0) {
                        $paketSiswa->update(['status' => 'Habis']);

                        $siswa = Siswa::find($siswa_id);
                        if ($siswa) {
                            $siswa->update(['status' => 'Nonaktif']);
                        }
                    }
                }
            }

            DB::commit();
            return back()->with('success', 'Absen berhasil. Siswa dengan kuota 0 otomatis dinonaktifkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses: ' . $e->getMessage());
        }
    }
public function monitoringKuota()
{
    $laporanKuota = PaketSiswa::with(['siswa', 'paket'])
        ->where('sisa_pertemuan', '>', 0)
        ->orderBy('sisa_pertemuan', 'asc')
        ->get();

    return view('jadwal.monitoring_kuota', compact('laporanKuota'));
}

public function siswaJadwal($paket_id, $siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        $paket = PaketBimbel::findOrFail($paket_id);

        $jadwals = JadwalMengajar::with(['mapel', 'guru'])
            ->where('paket_bimbel_id', $paket_id)
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->get();

        return view('jadwal.siswa_jadwal', compact('siswa', 'paket', 'jadwals'));
    }

}