<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\PaketBimbel;
use App\Models\Transaksi;
use App\Models\PaketSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class TransaksiController extends Controller
{
    public function create()
    {
        $siswa = Siswa::where('status', 'Nonaktif')->get();
        $paket = PaketBimbel::all();
        $jadwalMengajar = \App\Models\JadwalMengajar::all(); 

        return view('transaksi.create', compact('siswa', 'paket', 'jadwalMengajar'));
    }

public function store(Request $request)
{
    $request->validate([
        'siswa_id'        => 'required|exists:siswa,id',
        'paket_bimbel_id' => 'required|exists:paket_bimbel,id',
        'metode'          => 'required',
    ]);

    DB::beginTransaction();

    try {
        $paket = PaketBimbel::findOrFail($request->paket_bimbel_id);

        $tahun = now()->year;
        $lastTransaksi = Transaksi::whereYear('created_at', $tahun)->orderBy('id', 'desc')->first();
        $newNumber = ($lastTransaksi && $lastTransaksi->kode_pembayaran) ? ((int) substr($lastTransaksi->kode_pembayaran, -4)) + 1 : 1;
        $kodePembayaran = 'INV-' . $tahun . '-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        $trx = Transaksi::create([
            'kode_pembayaran'   => $kodePembayaran,
            'siswa_id'          => $request->siswa_id,
            'paket_bimbel_id'   => $paket->id,
            'tanggal_transaksi' => now(),
            'total'             => $paket->harga,
            'metode'            => $request->metode,
            'status'            => 'lunas'
        ]);

        \App\Models\Pemasukan::create([
            'siswa_id' => $request->siswa_id,
            'tanggal'  => now(),
            'jumlah'   => $paket->harga,
            'keterangan' => 'Pembayaran Paket: ' . $paket->nama_paket
        ]);

        PaketSiswa::create([
            'siswa_id'        => $request->siswa_id,
            'paket_bimbel_id' => $paket->id,
            'transaksi_id'    => $trx->id,
            'sisa_pertemuan'  => $paket->jumlah_pertemuan, 
            'status'          => 'aktif'
        ]);

        Siswa::where('id', $request->siswa_id)->update(['status' => 'Aktif']);

        DB::commit();
        return redirect()->route('transaksi.struk', $trx->id)->with('success', 'Transaksi Berhasil!');

    } catch (Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Gagal: ' . $e->getMessage());
    }
}

    public function struk($id)
    {
        $transaksi = Transaksi::with(['siswa', 'paket'])->findOrFail($id);
        return view('transaksi.struk', compact('transaksi'));
    }
public function riwayat(Request $request)
{
    $from = $request->from;
    $to   = $request->to;

    $incomes = \App\Models\Transaksi::with('siswa')
        ->when($from, function ($q) use ($from) {
            $q->whereDate('created_at', '>=', $from);
        })
        ->when($to, function ($q) use ($to) {
            $q->whereDate('created_at', '<=', $to);
        })
        ->get()
        ->map(function ($t) {
            return [
                'date_raw' => $t->created_at,
                'date'     => $t->created_at->format('d M Y'),
                'nama'     => 'Pembayaran: ' . ($t->siswa->nama ?? 'Siswa'),
                'tipe'     => 'Income',
                'total'    => $t->total
            ];
        });

    $expenses = \App\Models\Gaji::with('guru')
        ->when($from, function ($q) use ($from) {
            $q->whereDate('created_at', '>=', $from);
        })
        ->when($to, function ($q) use ($to) {
            $q->whereDate('created_at', '<=', $to);
        })
        ->get()
        ->map(function ($g) {
            return [
                'date_raw' => $g->created_at,
                'date'     => $g->created_at->format('d M Y'),
                'nama'     => 'Gaji Guru: ' . ($g->guru->nama ?? 'Guru'),
                'tipe'     => 'Expense',
                'total'    => $g->total_gaji
            ];
        });

    $semuaTransaksi = $incomes
        ->merge($expenses)
        ->sortByDesc('date_raw')
        ->values();

    return view('keuangan.riwayat', compact('semuaTransaksi'));
}
}