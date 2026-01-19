@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        font-size: 13px;
    }

    h1 { font-size: 24px !important; }
    h4 { font-size: 18px !important; }
    h6 { font-size: 14px !important; }
    h3 { font-size: 22px !important; }
    
    .fs-5 { font-size: 14px !important; } 
    .small { font-size: 11px !important; } 
    
    .table thead th {
        font-size: 11px !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .table tbody td {
        font-size: 12px !important;
    }
    .btn {
        font-size: 12px !important;
        font-weight: 600;
    }

    .badge {
        font-size: 10px !important;
    }
</style>

<div class="container">

    <div class="hero-banner position-relative mb-5" 
        style="
            background-image: url('{{ asset('img/classroom.jpg') }}');
            background-size: cover;
            background-position: center;
            border-radius: 20px;
            height: 320px;
        ">
        <div class="hero-text position-absolute"
            style="
                bottom: 30px; 
                left: 30px;
                color: white;
            ">
            <h1 class="fw-bold">Selamat Datang di Bimbimbel</h1>
            <p class="fs-5">Kelola kantor bimbingan belajar Anda dengan mudah dan efisien.</p>
        </div>
    </div>

    <h4 class="fw-bold mb-4">Konten Utama</h4>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
              <div class="menu-card p-4">
                <img src="img/icon_manajemen.png"
                style="width:30px; height:30px; object-fit:contain; margin-bottom:10px;">          
                <h6 class="fw-bold">Manajemen Siswa</h6>
                <p class="text-black small">Kelola data siswa, pendaftaran, dan informasi kontak.</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="menu-card p-4">
                <img src="img/icon_manajemen.png"
                style="width:30px; height:30px; object-fit:contain; margin-bottom:10px;">                
                <h6 class="fw-bold">Manajemen Pengajar</h6>
                <p class="text-black small">Kelola data pengajar dan informasi kontak.</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="menu-card p-4">
                <img src="img/icon_jadwal.png"
                style="width: 25px;; height: 25px;; object-fit:contain; margin-bottom:10px;">      
                <h6 class="fw-bold">Jadwal</h6>
                <p class="text-black small">Atur jadwal kelas dan ruang belajar.</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="menu-card p-4">
                <img src="img/icon_uang.png"
                style="width:25; height: 25px;; object-fit:contain; margin-bottom:10px;"> 
                <h6 class="fw-bold">Keuangan</h6>
                <p class="text-black small">Pantau keuangan masuk dan keuangan keluar.</p>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card p-4">
            <p class="text-black">Jumlah Siswa</p>
            <h3 class="fw-bold">{{ $jumlahSiswa }}</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card p-4">
            <p class="text-black">Jumlah Pengajar</p>
            <h3 class="fw-bold">{{ $jumlahPengajar }}</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card p-4">
<p class="text-black">Jumlah Mata Pelajaran</p>
<h3 class="fw-bold">{{ $jumlahMapel }}</h3>
        </div>
    </div>
</div>



</div>

@include('layouts.footer')

@endsection