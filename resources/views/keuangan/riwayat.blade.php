@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body {
        background: #f8f7fd;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
    }

    .card-history {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: none;
    }

    .btn-back {
        color: #6f5aa8;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 20px;
    }

    .filter-group .form-control {
        border-radius: 12px;
        font-size: 12px;
        border: 1px solid #e2e8f0;
    }

    .btn-filter {
        background: #6f5aa8;
        color: white;
        border-radius: 12px;
        padding: 8px 20px;
        border: none;
        font-size: 12px;
        font-weight: 600;
    }

    .table thead th {
        background: #f1effa;
        border: none;
        padding: 12px;
        font-weight: 700;
        color: #6f5aa8;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
    }

    .badge-soft {
        padding: 6px 12px;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 700;
        display: inline-block;
    }

    .badge-income { background: #e8f5e9; color: #2e7d32; }
    .badge-expense { background: #fff0f0; color: #ef4444; }

    .btn-detail {
        background: #f1effa;
        color: #6f5aa8;
        border-radius: 8px;
        padding: 5px 10px;
        border: none;
        font-size: 11px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-detail:hover { background: #6f5aa8; color: white; }

    .receipt-box {
        border: 2px dashed #e2e8f0;
        padding: 20px;
        border-radius: 15px;
        background: #fafafa;
    }
</style>

<div class="container py-4">
    <a href="{{ route('keuangan.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
    </a>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Riwayat Transaksi</h3>
            <p class="text-muted">Menampilkan semua catatan keuangan masuk dan keluar.</p>
        </div>

    </div>

    <div class="card-history">
        <form action="{{ url()->current() }}" method="GET" class="row g-2 mb-4 align-items-end">
            <div class="col-md-3">
                <label class="form-label text-muted fw-bold" style="font-size: 11px;">DARI TANGGAL</label>
                <input type="date" name="from" class="form-control" value="{{ request('from') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted fw-bold" style="font-size: 11px;">SAMPAI TANGGAL</label>
                <input type="date" name="to" class="form-control" value="{{ request('to') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn-filter w-100">
                    <i class="bi bi-filter"></i> Filter
                </button>
            </div>
            @if(request('from') || request('to'))
            <div class="col-md-2">
                <a href="{{ url()->current() }}" class="btn btn-light w-100" style="border-radius: 12px; font-size: 12px;">Reset</a>
            </div>
            @endif
        </form>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th class="text-end">Jumlah</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($semuaTransaksi as $index => $item)
                    <tr>
                        <td class="text-muted">
                            {{ \Carbon\Carbon::parse($item['date'])->format('d M Y') }}
                        </td>
                        <td>
                            <strong class="d-block text-dark">{{ $item['nama'] }}</strong>
                        </td>
                        <td>
                            <span class="badge-soft {{ $item['tipe'] === 'Income' ? 'badge-income' : 'badge-expense' }}">
                                {{ $item['tipe'] === 'Income' ? 'Pemasukan' : 'Pengeluaran' }}
                            </span>
                        </td>
                        <td class="text-end fw-bold {{ $item['tipe'] === 'Income' ? 'text-success' : 'text-danger' }}">
                            {{ $item['tipe'] === 'Income' ? '+' : '-' }} Rp {{ number_format($item['total'], 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            <button class="btn-detail" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $index }}">
                                <i class="bi bi-receipt"></i> Detail
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalDetail{{ $index }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0" style="border-radius: 20px;">
                                <div class="modal-body p-4">
                                    <div class="text-center mb-4">
                                        <div class="avatar-circle mx-auto mb-2" style="width: 50px; height: 50px; background: #f1effa; color: #6f5aa8; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                            <i class="bi bi-shield-check"></i>
                                        </div>
                                        <h5 class="fw-bold mb-0">Detail Transaksi</h5>
                                        <p class="text-muted small">ID Transaksi: TRX-{{ strtoupper(substr(md5($index), 0, 8)) }}</p>
                                    </div>
                                    
                                    <div class="receipt-box mb-3">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Status</span>
                                            <span class="fw-bold text-success">Berhasil</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Tanggal</span>
                                            <span class="fw-bold">{{ $item['date'] }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Deskripsi</span>
                                            <span class="fw-bold">{{ $item['nama'] }}</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between mt-2">
                                            <span class="text-muted">Total</span>
                                            <h4 class="fw-bold {{ $item['tipe'] === 'Income' ? 'text-success' : 'text-danger' }}">
                                                Rp {{ number_format($item['total'], 0, ',', '.') }}
                                            </h4>
                                        </div>
                                    </div>
                                    
                                    <button type="button" class="btn btn-secondary w-100 rounded-3" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-info-circle d-block fs-2 mb-2"></i>
                            Belum ada riwayat transaksi pada periode ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            @if(method_exists($semuaTransaksi, 'links'))
                {{ $semuaTransaksi->links() }}
            @endif
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection