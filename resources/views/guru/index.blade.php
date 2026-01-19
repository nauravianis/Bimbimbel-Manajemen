@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

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
    h3 { 
        font-weight: 700; 
        letter-spacing: -0.5px; 
    }
    .table-container { 
        background: white; 
        border-radius: 20px; 
        padding: 10px; 
        overflow: hidden; 
    }
    .table thead th { 
        font-size: 11px; 
        text-transform: uppercase; 
        letter-spacing: 0.5px; 
        font-weight: 700; 
        color: #555; 
        border-top: none; 
    }
    .table tbody td { 
        font-size: 12px; 
        color: #000 !important; 
        font-weight: 500; 
    }
    .table-hover-custom tbody tr:hover { 
        background-color: rgba(151, 133, 190, 0.1) !important; 
        transition: background-color 0.2s ease; 
    }
    .btn-mro { 
        background: #6f5aa8; 
        color: white; 
        border-radius: 15px; 
        font-size: 12px; 
        font-weight: 600; 
        padding: 10px 20px; 
        text-decoration: none; 
        }
</style>

<div class="container">
    <h3 class="fw-bold">Data Guru</h3>
    <p>Kelola data Guru</p>

    <div class="header-top mb-4 d-flex justify-content-between align-items-center">
        <form action="{{ route('guru.index') }}" method="GET" class="w-50">
            <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}" style="border-radius: 20px; border: none; padding: 12px 18px; background: #fcfcfdff;">
        </form>
        
        <a href="{{ route('guru.create') }}" class="btn btn-mro">Tambah Guru Baru</a>
    </div>

    <div class="table-container shadow-sm">
        <div class="table-responsive">
            <table class="table table-bordered table-hover-custom align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">No. Telp</th>
                        <th class="text-center">Tanggal lahir</th>
                        <th class="text-center">JK</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Tahun Masuk</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($guru as $item)
                        <tr>
                            <td class="fw-bold">{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->nomor_telp }}</td>
                            <td>{{ $item->tanggal_lahir ?? '-' }}</td>
                            <td class="text-center">{{ $item->jenis_kelamin ?? '-' }}</td>
                            <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $item->alamat ?? '-' }}</td>
                            <td class="text-center">{{ $item->created_at->format('Y') }}</td>
                            <td>
                                <div class="d-flex gap-1 justify-content-center">
                                    <a href="{{ route('guru.edit', $item->id) }}" class="btn btn-warning btn-sm px-3 text-white" style="font-size: 11px; border-radius: 10px;">Edit</a>
                                    <form action="{{ route('guru.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm px-3" style="font-size: 11px; border-radius: 10px;" onclick="return confirm('Yakin hapus?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center py-4">Data tidak ditemukan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
    @include('layouts.footer')
@endsection