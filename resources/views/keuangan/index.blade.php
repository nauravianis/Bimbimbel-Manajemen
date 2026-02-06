@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        background: linear-gradient(135deg, #9785be, #9785be);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
    }

    .header-top {
        background: #e3d9f8ff;
        border-radius: 25px;
        padding: 18px 30px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
    }

    .card-soft {
        background: white;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: none;
    }

    .summary-card {
        background: white;
        border-radius: 15px;
        padding: 15px;
        border-left: 4px solid #6f5aa8;
    }

    .summary-card small {
        font-size: 10px;
        font-weight: 700;
        color: #888;
        text-transform: uppercase;
    }

    .summary-card h5 {
        font-weight: 800;
        font-size: 1.1rem;
    }

    .btn-mro {
        background: #6f5aa8;
        color: white;
        border-radius: 15px;
        font-size: 12px;
        padding: 10px 20px;
        border: none;
    }

    .btn-outline-mro {
        border: 1.5px solid #6f5aa8;
        color: #6f5aa8;
        background: white;
        border-radius: 15px;
        font-size: 12px;
        padding: 10px 20px;
    }

    .chart-container {
        position: relative;
        height: 220px; 
        width: 100%;
    }

    .table td {
        font-size: 12px;
        border-bottom: 1px solid #f1f1f5;
    }

    .badge-soft {
        background: #f0eeff;
        color: #6f5aa8;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 700;
    }
</style>

<div class="container py-4">
    <h3 class="fw-bold">Laporan Keuangan</h3>
    <p class="text-muted">Kelola pemasukan, pengeluaran, dan gaji guru.</p>

    <div class="header-top mb-4 d-flex justify-content-end align-items-center">
        <div class="d-flex gap-2">
            <a href="{{ route('transaksi.create') }}" class="btn btn-mro"><i class="bi bi-plus-circle"></i> Pembayaran Siswa</a>
            <a href="{{ route('gaji.index') }}" class="btn btn-outline-mro"><i class="bi bi-wallet2"></i> Gaji Guru</a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="summary-card">
                <small>Total Saldo</small>
                <h5>Rp {{ number_format($saldo,0,',','.') }}</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-card" style="border-left-color:#8b7cf6">
                <small>Pemasukan</small>
                <h5>Rp {{ number_format($totalPemasukan,0,',','.') }}</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-card" style="border-left-color:#ef4444">
                <small>Pengeluaran</small>
                <h5>Rp {{ number_format($totalPengeluaran,0,',','.') }}</h5>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card-soft mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6>Tren Pemasukan & Pengeluaran</h6>
                    <div class="d-flex gap-3" style="font-size: 10px;">
                        <span><i class="bi bi-circle-fill" style="color: #6f5aa8;"></i> Pemasukan</span>
                        <span><i class="bi bi-circle-fill" style="color: #ef4444;"></i> Pengeluaran</span>
                    </div>
                </div>

                <div class="chart-container">
                    <canvas id="modernChart"></canvas>
                </div>
            </div>

            <div class="card-soft">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Transaksi Terbaru</h6>
                    <a href="{{ route('keuangan.riwayat') }}" class="text-decoration-none small fw-bold">Lihat Semua</a>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th class="text-end">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recent as $item)
                        <tr>
                            <td>
                                <strong>{{ $item['nama'] }}</strong><br>
                                <small class="text-muted">{{ $item['date'] }}</small>
                            </td>
                            <td>
                                <span class="badge-soft" style="{{ $item['tipe'] === 'Expense' ? 'background:#fff0f0;color:#ef4444' : '' }}">
                                    {{ $item['tipe'] === 'Income' ? 'Pemasukan' : 'Pengeluaran' }}
                                </span>
                            </td>
                            <td class="text-end fw-bold {{ $item['tipe']==='Income'?'text-success':'text-danger' }}">
                                {{ $item['tipe']==='Income' ? '+' : '-' }} Rp {{ number_format($item['total'],0,',','.') }}
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted">Belum ada transaksi</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-soft mb-4 text-center py-5">
                <div class="icon-circle bg-purple-light mx-auto mb-3" style="width: 60px; height: 60px; line-height: 60px; border-radius: 50%; background: #f1effa;">
                    <i class="bi bi-wallet2 text-purple fs-3" style="color: #6f5aa8;"></i>
                </div>
                <h6>Saldo Saat Ini</h6>
                <h4 class="fw-bold text-purple" style="color: #6f5aa8;">Rp {{ number_format($saldo,0,',','.') }}</h4>
                <p class="text-muted small">Update otomatis dari transaksi terakhir</p>
                <hr>
                <div class="text-start mt-3">
                    <small class="fw-bold text-muted d-block mb-2">INFO KEUANGAN</small>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Total Transaksi</span>
                        <span class="fw-bold">{{ count($recent) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('modernChart').getContext('2d');
        
        const labels = @json(collect($grafik)->pluck('label'));
        const incomeData = @json(collect($grafik)->pluck('income'));
        const expenseData = @json(collect($grafik)->pluck('expense'));

        const gradientIncome = ctx.createLinearGradient(0, 0, 0, 200);
        gradientIncome.addColorStop(0, 'rgba(111, 90, 168, 0.2)');
        gradientIncome.addColorStop(1, 'rgba(111, 90, 168, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: incomeData,
                        borderColor: '#6f5aa8',
                        backgroundColor: gradientIncome,
                        fill: true,
                        tension: 0.4, 
                        borderWidth: 3,
                        pointRadius: 0,
                        pointHoverRadius: 5
                    },
                    {
                        label: 'Pengeluaran',
                        data: expenseData,
                        borderColor: '#ef4444',
                        backgroundColor: 'transparent',
                        fill: false,
                        tension: 0.4,
                        borderDash: [5, 5],
                        borderWidth: 2,
                        pointRadius: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { display: false, beginAtZero: true },
                    x: { grid: { display: false }, ticks: { font: { size: 10 } } }
                }
            }
        });
    });
</script>

@include('layouts.footer')
@endsection