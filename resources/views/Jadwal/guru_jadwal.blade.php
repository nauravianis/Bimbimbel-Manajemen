@extends('layouts.app')

@section('content')
<style>
    body { background: #f4f7fe; font-family: 'Plus Jakarta Sans', sans-serif; }
    .schedule-card { border: none; border-radius: 15px; transition: transform 0.2s; background: white; }
    .schedule-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .day-badge { background: #6f5aa8; color: white; padding: 5px 15px; border-radius: 10px; font-weight: 600; font-size: 12px; }
    .time-text { color: #6f5aa8; font-weight: 700; font-size: 14px; }

    @media print {
        nav, header, footer, .btn-no-print {
            display: none !important;
        }
        body { background: #fff !important; }
        .schedule-card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
            break-inside: avoid;
        }
    }
</style>

<div class="container py-5">

    <div class="mb-4 d-flex justify-content-between align-items-start">
        <div>
            <h3 class="fw-bold mt-2">Jadwal Mengajar</h3>
            <p class="text-muted">Guru: {{ $guru->nama }}</p>
        </div>

        <button onclick="window.print()"
            class="btn btn-outline-primary btn-sm rounded-pill px-4 btn-no-print">
            🖨 Cetak Jadwal
        </button>
    </div>

    <div class="row g-3">
        @forelse($jadwals as $j)
        <div class="col-md-4 col-6">
            <div class="card schedule-card h-100 p-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <span class="day-badge">{{ $j->hari }}</span>
                    <span class="time-text">
                        {{ $j->jam_mulai }} - {{ $j->jam_selesai }}
                    </span>
                </div>

                <h5 class="fw-bold mb-1" style="font-size: 1.1rem;">
                    {{ $j->mapel->nama_mapel }}
                </h5>

                <p class="text-muted small mb-1">
                    Paket: {{ $j->paketBimbel->nama_paket }}
                </p>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada jadwal mengajar.</p>
        </div>
        @endforelse
    </div>

    <div class="d-none d-print-block mt-5 text-center">
        <hr>
        <small class="text-muted">
            Dicetak dari Sistem Bimbel • {{ now()->format('d/m/Y H:i') }}
        </small>
    </div>
</div>

@include('layouts.footer')
@endsection
