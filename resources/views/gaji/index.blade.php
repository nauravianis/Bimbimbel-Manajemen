@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body {
        background: linear-gradient(135deg, #9785be, #9785be);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .card-custom {
        background: white;
        border-radius: 25px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .table thead th {
        background: #f8f7ff;
        color: #6f5aa8;
        font-size: 11px;
        text-transform: uppercase;
        border: none;
        padding: 15px;
    }
    .btn-mro {
        background: #6f5aa8;
        color: white;
        border-radius: 12px;
        padding: 8px 18px;
        font-size: 12px;
        border: none;
        transition: 0.3s;
        font-weight: 600;
    }
    .btn-mro:hover { 
        background: #5a488c; 
        color: white; 
        transform: translateY(-2px); 
    }
    .input-tarif {
        border-radius: 10px;
        border: 1px solid #e1e1e1;
        padding: 5px 10px;
        width: 110px;
        font-weight: bold;
        color: #6f5aa8;
        outline: none;
    }
    .badge-sesi {
        background: #f1effa;
        color: #6f5aa8;
        padding: 6px 12px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 12px;
    }
</style>

<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-light border-0 shadow-sm rounded-4 alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill text-success me-2"></i>
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Pengaturan Gaji Guru</h3>
            <p>Kelola tarif dan selesaikan pembayaran gaji guru.</p>
        </div>
        <div class="bg-white px-4 py-2 rounded-4 shadow-sm text-center">
            <small class="text-muted d-block" style="font-size: 10px; text-transform: uppercase;">Periode Aktif</small>
            <span class="fw-bold" style="color: #6f5aa8;">{{ now()->translatedFormat('F Y') }}</span>
        </div>
    </div>

    <div class="card-custom p-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Nama Guru</th>
                        <th>Tarif per Jam</th>
                        <th class="text-center">Total Jam Hadir</th>
                        <th>Total Tagihan</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_guru as $guru)
                        {{-- HANYA TAMPILKAN GURU YANG PUNYA ABSENSI BELUM DIBAYAR --}}
                        @if($guru->total_hadir_belum_bayar > 0)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $guru->nama }}</div>
                                <small class="text-muted">ID: #{{ $guru->id }}</small>
                            </td>
                            <td>
                                <form action="{{ route('guru.update-tarif', $guru->id) }}" method="POST" class="d-flex align-items-center gap-1">
                                    @csrf
                                    <span class="text-muted small">Rp</span>
                                    <input type="number" name="tarif_per_jam" value="{{ $guru->tarif_per_jam }}">
                                    <button type="submit" class="btn btn-sm btn-light border" title="Simpan">
                                        <i class="bi bi-arrow-repeat text-primary"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="text-center">
                                <span class="badge-sesi">{{ $guru->total_hadir_belum_bayar }} Jam</span>
                            </td>
                            <td class="fw-bold" style="color: #6f5aa8;">
                            Rp {{ number_format($guru->total_hadir_belum_bayar * $guru->tarif_per_jam, 0, ',', '.') }}
                            </td>
                            <td class="text-end">
                                <form action="{{ route('gaji.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="guru_id" value="{{ $guru->id }}">
                                    <button type="submit" class="btn btn-mro">
                                        <i class="bi bi-wallet2 me-1"></i> Bayar Gaji
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection