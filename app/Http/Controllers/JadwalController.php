<?php

namespace App\Http\Controllers;

use App\Models\JadwalMengajar;
use App\Models\Mapel;
use App\Models\Guru;
use App\Models\PaketBimbel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');
        $now = Carbon::now();
        $daysInMonth = $now->daysInMonth;
        $today = $now->translatedFormat('l');

        $mapelStat = JadwalMengajar::with('mapel')
            ->select('mapel_id')
            ->selectRaw('count(*) as total')
            ->groupBy('mapel_id')
            ->get();

        $jadwalHariIni = JadwalMengajar::with(['mapel', 'guru', 'paketBimbel'])
            ->where('hari', $today)
            ->orderBy('jam_mulai')
            ->get();

        $upcoming = JadwalMengajar::with(['mapel', 'guru', 'paketBimbel'])
            ->where('hari', '!=', $today)
            ->limit(3)
            ->get();

        return view('Jadwal.index', compact(
            'now',
            'daysInMonth',
            'mapelStat',
            'jadwalHariIni',
            'upcoming'
        ));
    }
    public function manage(Request $request)
    {
        $query = JadwalMengajar::with(['mapel', 'guru']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('hari', 'LIKE', "%$search%")
                ->orWhereHas('mapel', function ($q) use ($search) {
                    $q->where('nama_mapel', 'LIKE', "%$search%");
                })
                ->orWhereHas('guru', function ($q) use ($search) {
                    $q->where('nama', 'LIKE', "%$search%");
                });
        }

        $daftarJadwal = $query->get();
        return view('jadwal.manage', compact('daftarJadwal'));
    }


    public function create()
    {
        return view('Jadwal.create', [
            'mapel' => Mapel::all(),
            'guru' => Guru::all(),
            'paketBimbel' => PaketBimbel::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:guru,id',
            'paket_bimbel_id' => 'required|exists:paket_bimbel,id',
            'mapel_id' => 'required|exists:mapel,id',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        JadwalMengajar::create([
            'guru_id' => $request->guru_id,
            'paket_bimbel_id' => $request->paket_bimbel_id,
            'mapel_id' => $request->mapel_id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()
            ->route('jadwal.manage')
            ->with('success', 'Jadwal berhasil ditambahkan');
    }
    public function edit($id)
    {
        return view('Jadwal.edit', [
            'jadwal' => JadwalMengajar::findOrFail($id),
            'mapel' => Mapel::all(),
            'guru' => Guru::all(),
            'paketBimbel' => PaketBimbel::all(),
        ]);
    }
    public function update(Request $request, $id)
    {

        try {
            $jadwal = JadwalMengajar::findOrFail($id);
            $jadwal->update($request->all());
            return redirect()->route('jadwal.manage')->with('success', 'Berhasil update');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy($id)
    {
        JadwalMengajar::destroy($id);

        return redirect()
            ->route('jadwal.manage')
            ->with('success', 'Jadwal berhasil dihapus');
    }

    public function guruJadwal($guru_id)
{
    $guru = Guru::findOrFail($guru_id);

    $jadwals = JadwalMengajar::with(['mapel', 'paketBimbel'])
        ->where('guru_id', $guru_id)
        ->orderByRaw("
            FIELD(hari,
            'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')
        ")
        ->orderBy('jam_mulai')
        ->get();

    return view('jadwal.guru_jadwal', compact('guru', 'jadwals'));
}


}
