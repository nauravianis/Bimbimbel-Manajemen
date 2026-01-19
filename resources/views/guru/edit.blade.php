@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #9785be, #9785be);
    }

    .form-wrapper {
        max-width: 1000px;
        margin: auto;
    }

    .card-form {
        background: #fdfcff;
        border-radius: 26px;
        padding: 32px 36px;
        box-shadow:
            0 20px 40px rgba(0,0,0,0.08),
            inset 0 0 0 1px rgba(111,90,168,0.08);
    }

    .card-header-soft {
        background: #e3d9f8ff;
        border-radius: 20px;
        padding: 18px 24px;
        margin-bottom: 28px;
    }

    .form-control, .form-select {
        border-radius: 16px;
        padding: 12px 16px;
        border: 1px solid #eceaf3;
        background: #ffffff;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 3px rgba(111,90,168,0.15);
        border-color: #6f5aa8;
    }

    .btn-mro {
        background: linear-gradient(135deg, #6f5aa8, #5b4696);
        color: #fff;
        border-radius: 18px;
        padding: 10px 28px;
        border: none;
    }

    .section-title {
        font-weight: 600;
        font-size: 15px;
        color: #5b4696;
        margin: 26px 0 12px;
    }
</style>

<div class="container py-4">
    <h3 class="fw-bold mb-1">Edit Data Guru</h3>
        <p class="text-muted mb-4">Perbarui informasi guru dalam sistem</p>

    <div class="form-wrapper">
        <div class="card-form">

            <div class="card-header-soft d-flex align-items-center gap-3">
                <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center"
                     style="width:52px;height:52px;">
                    👩‍🏫
                </div>
                <div>
                    <div class="fw-semibold">Informasi Guru</div>
                    <small class="text-muted">Pastikan data yang diubah sudah benar</small>
                </div>
            </div>

            <form action="{{ route('guru.update', $guru->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="section-title">Data Utama</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="small fw-semibold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ $guru->nama }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="small fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $guru->email }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="small fw-semibold">No. Telepon</label>
                        <input type="text" name="nomor_telp" class="form-control" value="{{ $guru->nomor_telp }}" required>
                    </div>
                </div>

                <div class="section-title">Data Pribadi</div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="fw-semibold small">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ $guru->tanggal_lahir }}">
                    </div>

                    <div class="col-md-4">
                        <label class="small fw-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select">
                            <option disabled>Pilih</option>
                            <option value="Laki-laki" {{ $guru->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $guru->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="section-title">Alamat</div>
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="small fw-semibold">Alamat Lengkap</label>
                        <input type="text" name="alamat" class="form-control" value="{{ $guru->alamat }}">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('guru.index') }}" class="btn btn-light rounded-pill px-4">
                        Batal
                    </a>
                    <button type="submit" class="btn-mro">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection