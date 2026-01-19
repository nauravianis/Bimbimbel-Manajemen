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
        <h3 class="fw-bold mb-1">Tambah Jadwal Pelajaran</h3>
        <p class="mb-4">Atur jadwal baru untuk kegiatan belajar mengajar</p>
    <div class="form-wrapper">

        <div class="card-form">

            <div class="card-header-soft d-flex align-items-center gap-3">
                <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center"
                     style="width:52px;height:52px; font-size: 24px;">
                    📅
                </div>
                <div>
                    <div class="fw-semibold">Tambah Jadwal Baru</div>
                    <small class="text-muted">Isi data jadwal</small>
                </div>
            </div>

            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf

                <div class="section-title">Detail Pelajaran</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="small fw-semibold">Mata Pelajaran</label>
                        <select name="mapel_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Mata Pelajaran</option>
                            @foreach($mapel as $m)
                                <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="small fw-semibold">Guru Pengajar</label>
                        <select name="guru_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Guru</option>
                            @foreach($guru as $g)
                                <option value="{{ $g->id }}">{{ $g->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="section-title">Paket & Waktu</div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="small fw-semibold">Paket Bimbel</label>
                        <select name="paket_bimbel_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Paket</option>
                            @foreach($paketBimbel as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_paket }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="small fw-semibold">Hari</label>
                        <select name="hari" class="form-select" required>
                            <option value="" disabled selected>Pilih Hari</option>
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
                                <option value="{{ $h }}">{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="small fw-semibold">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" required>
                    </div>

                    <div class="col-md-2">
                        <label class="small fw-semibold">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control" required>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-5">
                    <a href="{{ route('jadwal.index') }}" class="btn btn-light rounded-pill px-4 fw-semibold">
                        Batal
                    </a>
                    <button type="submit" class="btn-mro">
                        Simpan Jadwal
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
