@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body {
        background: linear-gradient(135deg, #9785be, #9785be);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .struk-wrapper {
        max-width: 550px;
        margin: auto;
    }

    .struk-card {
        background: #ffffff;
        border-radius: 26px;
        padding: 40px;
        box-shadow: 0 20px 45px rgba(0,0,0,.12);
    }

    /* Sinkronisasi dengan Modal Detail */
    .avatar-circle {
        width: 65px; 
        height: 65px; 
        background: #f1effa; 
        color: #6f5aa8; 
        border-radius: 50%; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 30px;
    }

    .receipt-box {
        border: 2px dashed #e2e8f0;
        padding: 25px;
        border-radius: 20px;
        background: #fafafa;
    }

    .receipt-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 14px;
    }

    .receipt-item .label {
        color: #6c757d;
    }

    .receipt-item .value {
        font-weight: 700;
        color: #212529;
        text-align: right;
    }

    .total-amount {
        font-size: 26px;
        font-weight: 800;
        color: #6f5aa8;
    }

    .status-badge-paid {
        background: #e8f5e9;
        color: #2e7d32;
        padding: 8px 18px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
        margin-top: 10px;
    }

    /* BUTTONS */
    .btn-group-bottom {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-top: 30px;
    }

    .btn-soft {
        border-radius: 18px;
        padding: 12px 24px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-primary-soft {
        background: #6f5aa8;
        color: #fff;
    }

    .btn-primary-soft:hover {
        background: #5b4696;
        color: #fff;
        transform: translateY(-2px);
    }

    .btn-outline-soft {
        background: #fff;
        border: 1px solid rgba(255,255,255,0.4);
        color: #444;
    }

    .btn-back-nav {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        backdrop-filter: blur(10px);
    }

    @media print {
        body { background: #fff !important; }
        .btn-group-bottom, nav, footer, .btn-back-nav { display: none !important; }
        .struk-card { box-shadow: none; padding: 0; }
        .struk-wrapper { max-width: 100%; }
    }
</style>

<div class="container py-5">
    <div class="struk-wrapper">
        
        <div class="struk-card" id="print-area">
            
            <div class="text-center mb-4">
                <div class="avatar-circle mx-auto mb-3">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h4 class="fw-bold mb-1">BIMBIMBEL</h4>
                <p class="text-muted small mb-0">Struk Pembayaran Resmi</p>
                <div class="status-badge-paid">
                    <i class="bi bi-patch-check-fill me-1"></i> {{ strtoupper($transaksi->status) }}
                </div>
            </div>

            <div class="receipt-box">
                <div class="receipt-item">
                    <span class="label">Kode Pembayaran</span>
                    <span class="value">#{{ $transaksi->kode_pembayaran }}</span>
                </div>
                <div class="receipt-item">
                    <span class="label">Tanggal & Waktu</span>
                    <span class="value">{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y, H:i') }} WIB</span>
                </div>
                
                <hr style="border-top: 2px dashed #e2e8f0; opacity: 1; margin: 20px 0;">

                <div class="receipt-item">
                    <span class="label">Nama Siswa</span>
                    <span class="value">{{ $transaksi->siswa->nama }}</span>
                </div>
                <div class="receipt-item">
                    <span class="label">Paket Bimbel</span>
                    <span class="value">{{ $transaksi->paket->nama_paket }}</span>
                </div>
                <div class="receipt-item">
                    <span class="label">Metode Pembayaran</span>
                    <span class="value">{{ $transaksi->metode }}</span>
                </div>

                <hr style="border-top: 2px dashed #e2e8f0; opacity: 1; margin: 20px 0;">
                
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted fw-bold">TOTAL BAYAR</span>
                    <span class="total-amount">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted small mb-0">
                    Struk ini adalah bukti pembayaran sah.<br>
                    Harap simpan baik-baik.
                </p>
            </div>
        </div>

        <div class="btn-group-bottom">
            <a href="{{ route('jadwal.siswa', [$transaksi->paket_bimbel_id, $transaksi->siswa_id]) }}" class="btn btn-soft btn-primary-soft">
                <i class="bi bi-calendar3"></i> Lihat Jadwal
            </a>

            <button onclick="window.print()" class="btn btn-soft btn-outline-soft shadow-sm">
                <i class="bi bi-printer"></i> Print Struk
            </button>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('keuangan.index') }}" class="btn btn-soft btn-back-nav py-2">
                <i class="bi bi-arrow-left"></i> Dashboard
            </a>
        </div>

    </div>
</div>

@include('layouts.footer')
@endsection