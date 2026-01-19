@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

    h3 { font-weight: 700; }
    
    .table-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .table thead th {
        font-size: 12px;
        font-weight: 700;
        color: #000;
        border-bottom: 2px solid #f1f1f5;
        padding: 15px 10px;
    }

    .table tbody td {
        font-size: 12px;
        font-weight: 500;
        padding: 12px 10px;
        border-bottom: 1px solid #f1f1f5;
        vertical-align: middle;
    }

    .badge-soft {
        background: #f0eeff;
        color: #6f5aa8;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 700;
    }

    .btn-mro {
        background: #6f5aa8;
        color: white;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 600;
        padding: 8px 16px;
        border: none;
        text-decoration: none;
        display: inline-block;
    }

    .btn-action {
        padding: 5px 10px;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
    }
    .btn-edit-soft { background: #e8f2ff; color: #2d8cf0; }
    .btn-delete-soft { background: #fff0f0; color: #ff5c5c; border: none; }
</style>

<div class="container py-4">

    <h3 class="fw-bold">Data Jadwal</h3>
    <p>Kelola seluruh daftar pelajaran, waktu, dan pengajar.</p>

    <div class="header-top mb-4 d-flex justify-content-between align-items-center">
        <form action="{{ route('jadwal.manage') }}" method="GET" class="w-50">
            <input type="text" name="search" class="form-control" 
                placeholder="Search..." 
                value="{{ request('search') }}"
                style="border-radius:20px; border:none; padding: 10px 20px;">
        </form>

        <div class="d-flex gap-2">
            <a href="{{ route('jadwal.index') }}" class="btn btn-light shadow-sm" style="border-radius:15px; font-size:12px; font-weight:600; padding: 8px 16px;">
                Kembali
            </a>
            <a href="{{ route('jadwal.create') }}" class="btn btn-mro">
                Tambah Jadwal Baru
            </a>
        </div>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Hari</th>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                        <th>Waktu</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($daftarJadwal as $j)
                    <tr>
                        <td><span class="badge-soft text-uppercase">{{ $j->hari }}</span></td>
                        <td>
                            <div class="fw-bold" style="color: #000;">{{ $j->mapel->nama_mapel ?? 'N/A' }}</div>
                        </td>
                        <td>{{ $j->guru->nama ?? 'N/A' }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <i class="far fa-clock text-muted"></i>
                                {{ $j->jam_mulai }} - {{ $j->jam_selesai }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('jadwal.edit', $j->id) }}" class="btn btn-warning btn-sm px-3 text-white" style="font-size: 11px; border-radius: 10px;">
                                    Edit
                                </a>
                                <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST" 
                                      onsubmit="return confirm('Hapus jadwal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm px-3" style="font-size: 11px; border-radius: 10px;">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Data jadwal tidak ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection