@extends('layouts.app')

@section('content')
<style>
    body { background: #f4f7fe; font-family: 'Plus Jakarta Sans', sans-serif; }
    .schedule-card { border: none; border-radius: 15px; transition: transform 0.2s; background: white; }
    .schedule-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .day-badge { background: #6f5aa8; color: white; padding: 5px 15px; border-radius: 10px; font-weight: 600; font-size: 12px; }
    .time-text { color: #6f5aa8; font-weight: 700; font-size: 14px; }

    @media print {
        nav, .navbar, header, footer, .btn-no-print, .text-decoration-none {
            display: none !important;
        }

        body {
            background: #fff !important;
            margin: 0;
            padding: 0;
        }

        .schedule-card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
            break-inside: avoid; 
        }

        .container {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
        }

        .day-badge {
            background-color: #6f5aa8 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>

<div class="container py-5">
    <div class="mb-4 d-flex justify-content-between align-items-start">
        <div>
            
           <h3 class="fw-bold mt-2">Jadwal Mingguan: {{ $siswa->nama }}</h3>
            <p class="text-muted">Paket: {{ $paket->nama_paket }}</p>
        </div>
        
        <button onclick="window.print()" class="btn btn-outline-primary btn-sm rounded-pill px-4 btn-no-print">
            <i class="bi bi-printer me-1"></i> Cetak Jadwal
        </button>
    </div>

    <div class="row g-3">
        @forelse($jadwals as $j)
        <div class="col-md-4 col-6"> <div class="card schedule-card h-100 p-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <span class="day-badge">{{ $j->hari }}</span>
                    <span class="time-text">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</span>
                </div>
                <h5 class="fw-bold mb-1" style="font-size: 1.1rem;">{{ $j->mapel->nama_mapel }}</h5>
                <p class="text-muted small mb-0">Guru: {{ $j->guru->nama ?? 'Belum ditentukan' }}</p>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Tidak ada jadwal rutin untuk paket ini.</p>
        </div>
        @endforelse
    </div>

    <div class="d-none d-print-block mt-5 text-center">
        <hr>
        <small class="text-muted">Dicetak otomatis melalui Sistem Bimbimbel - {{ now()->format('d/m/Y H:i') }}</small>
    </div>
</div>
    @include('layouts.footer')

@endsection