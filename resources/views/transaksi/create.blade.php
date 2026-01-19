@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

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
        box-shadow: 0 20px 40px rgba(0,0,0,.08);
    }

    .card-header-soft {
        background: #e3d9f8ff;
        border-radius: 20px;
        padding: 18px 24px;
        margin-bottom: 28px;
    }

    .form-control,
    .form-select,
    .select2-container--default .select2-selection--single {
        height: 56px !important;
        padding: 14px 18px !important;
        font-size: 15px;
        border-radius: 18px !important;
        display: flex;
        align-items: center;
    }

    .select2-selection__rendered {
        line-height: normal !important;
        padding-left: 0 !important;
    }

    .select2-selection__arrow {
        height: 100% !important;
    }

    .select2-results__option {
        padding: 12px 18px;
        font-size: 14px;
    }

    .select2-search__field {
        height: 42px;
        font-size: 14px;
    }

    .btn-mro {
        background: linear-gradient(135deg, #6f5aa8, #5b4696);
        color: #fff;
        border-radius: 18px;
        padding: 10px 28px;
        border: none;
        font-weight: 600;
    }

    .section-title {
        font-weight: 600;
        color: #5b4696;
        margin: 26px 0 12px;
    }
</style>

<div class="container py-4">

    <h3 class="fw-bold mb-1">Transaksi Paket Bimbel</h3>
    <p class="text-muted mb-4">Aktifkan paket bimbel untuk siswa</p>

    @if(session('error'))
        <div class="alert alert-danger rounded-3">
            {{ session('error') }}
        </div>
    @endif

    <div class="form-wrapper">
        <div class="card-form">

            <div class="card-header-soft d-flex align-items-center gap-3">
                <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center"
                     style="width:52px;height:52px;">
                    💳
                </div>
                <div>
                    <div class="fw-semibold">Form Transaksi</div>
                    <small class="text-muted">Cari siswa & paket</small>
                </div>
            </div>

            <form method="POST" action="{{ route('transaksi.store') }}">
                @csrf

                <div class="section-title">Siswa</div>
                <select name="siswa_id" class="form-select select2" required>
                    <option value="">Pilih siswa</option>
                    @foreach($siswa as $s)
                        <option value="{{ $s->id }}">
                            {{ $s->nama }} — {{ $s->sekolah }}
                        </option>
                    @endforeach
                </select>

                <div class="section-title">Paket Bimbel</div>
                <select name="paket_bimbel_id" class="form-select select2" required>
                    <option value="">Pilih paket</option>
                    @foreach($paket as $p)
                        <option value="{{ $p->id }}">
                            {{ $p->nama_paket }} — Rp{{ number_format($p->harga) }}
                        </option>
                    @endforeach
                </select>

                <div class="section-title">Metode Pembayaran</div>
                <select name="metode" class="form-select w-50">
                    <option value="Cash">Cash</option>
                    <option value="Transfer">Transfer</option>
                </select>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('keuangan.index') }}" class="btn btn-light rounded-pill px-4">
                        Batal
                    </a>
                    <button class="btn-mro">
                        Aktifkan Paket
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Ketik untuk mencari...',
            width: '100%'
        });
    });
</script>

@include('layouts.footer')
@endsection
