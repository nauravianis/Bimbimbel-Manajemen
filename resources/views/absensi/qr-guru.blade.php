@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
body {
    background: linear-gradient(135deg, #c9c3ff 0%, #e2dfff 100%);
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: #2d3436;
    font-size: 13px;
}

.fin-wrapper {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    border-radius: 30px;
    padding: 25px 30px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.card-soft {
    background: #fff;
    border-radius: 20px;
    padding: 20px;
    border: none;
    box-shadow: 0 8px 25px rgba(111, 90, 168, 0.03);
}

.table thead th {
    background: #f8f9fe;
    color: #8b8fa8;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 10px;
    letter-spacing: 0.8px;
    padding: 12px 15px;
    border: none;
}

.table td {
    padding: 12px 15px;
    border-bottom: 1px solid #f1f1f5;
    font-size: 12px;
}

.btn-qr {
    background: #6f5aa8;
    color: white;
    font-size: 11px;
    font-weight: 600;
    border-radius: 8px;
    padding: 5px 12px;
    border: none;
    transition: 0.3s;
}

.btn-qr:hover {
    background: #5a4891;
    color: white;
    transform: translateY(-1px);
}

.avatar-initial {
    width: 30px;
    height: 30px;
    background: #eeeaff;
    color: #6f5aa8;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 11px;
}
</style>

<div class="container py-4">
    <div class="fin-wrapper">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0" style="font-size: 1.2rem;">Daftar Guru</h4>
                <p class="text-muted mb-0" style="font-size: 11px;">Pilih guru untuk mencetak kode QR absensi</p>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-light rounded-pill px-3" style="font-size: 11px;">
                 Kembali
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm py-2 px-3 mb-3" style="font-size: 12px; border-radius: 12px;">
                <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card-soft">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Guru</th>
                            <th>Kontak / Email</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guru as $g)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-initial">
                                        {{ strtoupper(substr($g->nama, 0, 2)) }}
                                    </div>
                                    <div class="fw-bold text-dark">{{ $g->nama }}</div>
                                </div>
                            </td>

                            <td class="text-muted">{{ $g->email }}</td>
                            <td class="text-center">
                                <form action="{{ route('absensi.qr.generate', $g->id) }}" method="POST"
                                      onsubmit="return confirm('Buat QR untuk {{ $g->nama }}?')">
                                    @csrf
                                    <button type="submit" class="btn btn-qr">
                                        <i class="bi bi-qr-code me-1"></i> Buat QR
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
@include('layouts.footer')
@endsection