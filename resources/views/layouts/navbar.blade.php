<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bimbel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
</head>
<nav class="navbar navbar-expand-lg custom-navbar shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">

        <!-- Brand -->
        <a class="navbar-brand fw-bold custom-brand" href="#">
            BIMBIMBEL
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <img src="{{ asset('img/admin-logo.jpg') }}" 
                 alt="icon" 
                 style="width: 28px; height: 28px; border-radius: 50%; object-fit: cover;">
        </button>

        <!-- Menu Tengah -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto gap-3 custom-nav">
                <li class="nav-item">
                    <a class="nav-link custom-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"href="{{ route('dashboard') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-link {{ request()->routeIs('siswa.index') ? 'active' : '' }}"href="{{ route('siswa.index') }}">Siswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-link {{ request()->routeIs('guru.index') ? 'active' : '' }}"href="{{ route('guru.index') }}">Guru</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-link {{ request()->routeIs('jadwal.index') ? 'active' : '' }}"href="{{ route('jadwal.index') }}">Jadwal</a>
                </li>                
                <li class="nav-item">
                    <a class="nav-link custom-link {{ request()->routeIs('absensi.index') ? 'active' : '' }}"href="{{ route('absensi.index') }}">Absensi</a>
                </li>                 
                <li class="nav-item">
                    <a class="nav-link custom-link {{ request()->routeIs('keuangan.index') ? 'active' : '' }}"href="{{ route('keuangan.index') }}">Keuangan</a>
                </li>             
            </ul>

            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none" 
                    id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('img/admin-logo.jpg') }}"
                        alt="Admin icon"
                        class="profile-img">
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>
