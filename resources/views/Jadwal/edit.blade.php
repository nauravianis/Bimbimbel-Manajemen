@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #9785be, #9785be);
        font-family: 'Plus Jakarta Sans', sans-serif;
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
        font-size: 14px;
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
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-mro:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(111,90,168,0.3);
        color: #fff;
    }

    .section-title {
        font-weight: 600;
        font-size: 15px;
        color: #5b4696;
        margin: 26px 0 12px;
    }
</style>

<div class="container py-4">
        <h3 class="fw-bold mb-1">Edit Jadwal Pelajaran</h3>
        <p class="mb-4">Perbarui data jadwal pelajaran</p>

    <div class="form-wrapper">
        <div class="card-form">

            <div class="card-header-soft d-flex align-items-center gap-3">
                <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center"
                     style="width:52px;height:52px; font-size: 24px;">
                    📅
                </div>
                <div>
                    <div class="fw-semibold">Informasi Jadwal</div>
                    <small class="text-muted">ID Jadwal: #{{ $jadwal->id }}</small>
                </div>
            </div>

            <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="section-title">Detail Pelajaran</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="small fw-semibold">Mata Pelajaran</label>
                        <select name="mapel_id" class="form-select" required>
                            <option value="" disabled>Pilih Mata Pelajaran</option>
                            @foreach($mapel as $m)
                                <option value="{{ $m->id }}" {{ $jadwal->mapel_id == $m->id ? 'selected' : '' }}>
                                    {{ $m->nama_mapel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="small fw-semibold">Guru Pengajar</label>
                        <select name="guru_id" class="form-select" required>
                            <option value="" disabled>Pilih Guru</option>
                            @foreach($guru as $g)
                                <option value="{{ $g->id }}" {{ $jadwal->guru_id == $g->id ? 'selected' : '' }}>
                                    {{ $g->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="section-title">Waktu & Hari</div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="small fw-semibold">Hari</label>
                        <select name="hari" class="form-select" required>
                            @php $hariArray = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']; @endphp
                            @foreach($hariArray as $h)
                                <option value="{{ $h }}" {{ $jadwal->hari == $h ? 'selected' : '' }}>{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="small fw-semibold">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" value="{{ $jadwal->jam_mulai }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="small fw-semibold">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control" value="{{ $jadwal->jam_selesai }}" required>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-5">
                    <a href="{{ route('jadwal.manage') }}" class="btn btn-light rounded-pill px-4" style="font-weight: 600;">
                        Batal
                    </a>
                    <button type="submit" class="btn-mro">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection