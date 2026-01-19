@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body {
        background: linear-gradient(135deg, #9785be, #9785be);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
    }

    .header-top {
        background: #e3d9f8ff;
        backdrop-filter: blur(20px);
        border-radius: 25px;
        padding: 18px 30px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
    }

    h3 { font-weight: 700; letter-spacing: -0.5px;}
    h6 { font-size: 14px !important; font-weight: 700; color: #000000; }
    p.text-muted { font-size: 12px;}

    .card-soft {
        background: white;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .search-input {
        border-radius: 20px;
        border: none;
        padding: 12px 18px;
        background: #fcfcfdff;
        font-size: 12px;
        width: 100%;
    }

    .btn-mro {
        background: #6f5aa8;
        color: white;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 600;
        padding: 10px 20px;
        border: none;
    }
    .btn-outline-mro {
        border: 1.5px solid #6f5aa8;
        color: #6f5aa8;
        background: white;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 600;
        padding: 10px 20px;
    }

    .table thead th {
        background: #f8f9fe;
        border: none;
        color: #8b8fa8;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 10px;
        letter-spacing: 0.8px;
        padding: 15px;
    }
    .table td {
        padding: 15px;
        border-bottom: 1px solid #f1f1f5;
        font-size: 12.5px;
        color: #000000;
    }

    .avatar-circle {
        width: 32px;
        height: 32px;
        background: #f1effa;
        color: #6f5aa8;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 11px;
    }

    .badge-soft-success {
        background: #e7f6f2;
        color: #0d9488;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 700;
    }
</style>

<div class="container py-4">

    <h3 class="fw-bold">Absensi Guru</h3>
    <p class="text-muted">Monitoring kehadiran pengajar bimbingan belajar hari ini</p>

    <div class="header-top mb-4">
        <div class="row align-items-center g-3">
            <div class="col-md-6">
                <form action="{{ url()->current() }}" method="GET">
                <div class="position-relative">
                    <input type="text" name="search" class="search-input" 
                           placeholder="Cari nama..." 
                           value="{{ request('search') }}">
                    <button type="submit" class="d-none"></button>
                </div>
            </form>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-flex gap-2 justify-content-md-end">
<a href="{{ route('absensi.scan') }}" class="btn btn-mro">
    <i class="bi bi-qr-code-scan me-1"></i> Scan QR
</a>

<a href="{{ route('absensi.qr.guru') }}" class="btn btn-outline-mro">
    <i class="bi bi-person-badge me-1"></i> Buat QR Guru
</a>

<a href="{{ route('monitoring.kuota') }}" class="btn btn-outline-mro">
    <i class="bi bi-speedometer2 me-1"></i> Monitoring Kuota
</a>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 py-3 px-4 mb-4 d-flex align-items-center" style="font-size: 12px; background: white; color: #0d9488;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card-soft">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="fw-bold mb-0">Daftar Kehadiran</h6>
            <span class="text-muted fw-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px; color: #8b8fa8 !important;">
                <i class="bi bi-calendar3 me-1"></i> {{ date('d M Y') }}
            </span>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Nama Guru</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensi as $row)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-circle">
                                        {{ strtoupper(substr($row->guru->nama, 0, 2)) }}
                                    </div>
                                    <div class="fw-bold">{{ $row->guru->nama }}</div>
                                </div>
                            </td>
                          
                <td>
                                <span class="fw-semibold"><i class="bi bi-clock me-1" style="color: #6f5aa8;"></i> {{ $row->jam_masuk ?? '--:--' }}</span>
                            </td>
                            <td>
                                <span class="fw-semibold"><i class="bi bi-door-open me-1 text-danger"></i> {{ $row->jam_keluar ?? '--:--' }}</span>
                            </td>
                            <td class="text-center">
                                @if($row->jam_masuk)
                                    <span class="badge-soft-success">Hadir</span>
                                @else
                                    <span class="badge bg-light text-muted border fw-bold" style="font-size: 10px; padding: 4px 10px;">Pending</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <p class="text-muted mb-0">Belum ada aktivitas absensi hari ini</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@include('layouts.footer')
@endsection