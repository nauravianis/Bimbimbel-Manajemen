<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Gaji;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KeuanganController extends Controller
{
    public function index()
    {
        $totalPemasukan = Transaksi::where('status', 'lunas')->sum('total');
        $totalPengeluaranGaji = Gaji::sum('total_gaji');

        $totalPengeluaranLain = \App\Models\Pengeluaran::sum('jumlah') ?? 0;

        $totalPengeluaran = $totalPengeluaranGaji + $totalPengeluaranLain;
        $saldo = $totalPemasukan - $totalPengeluaran;

        $grafik = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $label = Carbon::now()->subDays($i)->isoFormat('ddd');

            $income = Transaksi::whereDate('tanggal_transaksi', $date)
                ->where('status', 'lunas')
                ->sum('total');

            $expense = Gaji::whereDate('tanggal', $date)->sum('total_gaji');

            $grafik[] = [
                'label' => $label,
                'income' => $income,
                'expense' => $expense,
                'count_siswa_baru' => Siswa::whereDate('created_at', $date)->count(),
            ];
        }

        $recentIncome = Transaksi::with('siswa')->latest()->take(5)->get()->map(function ($t) {
            return [
                'date' => $t->created_at->format('d M'),
                'nama' => $t->siswa->nama ?? 'Siswa Umum',
                'tipe' => 'Income',
                'judul' => 'Pembayaran Paket',
                'total' => $t->total
            ];
        });

        $recentExpense = Gaji::with('guru')->latest()->take(5)->get()->map(function ($g) {
            return [
                'date' => $g->created_at->format('d M'),
                'nama' => $g->guru->nama ?? 'Guru Umum',
                'tipe' => 'Expense',
                'judul' => 'Gaji Guru',
                'total' => $g->total_gaji
            ];
        });

        $recent = $recentIncome
            ->merge($recentExpense)
            ->sortByDesc(function ($item) {
                return $item['date'];
            })
            ->take(5);

        return view('keuangan.index', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'grafik',
            'recent'
        ));

    }
}