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
        position: relative;
    }

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
        margin-bottom: 12px;
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

    .status-paid {
        background: #e8f5e9;
        color: #2e7d32;
        padding: 6px 16px;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 700;
        display: inline-block;
        margin-top: 5px;
    }

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
        color: #fff !important;
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
        .struk-card { box-shadow: none; padding: 20px; border: 1px solid #eee; }
        .struk-wrapper { max-width: 100%; }
    }
</style>

<div class="container py-5">
    <div class="struk-wrapper">
        
        <div class="struk-card">
            <div class="text-center mb-4">
                <div class="avatar-circle mx-auto mb-3">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <h4 class="fw-bold mb-1">SLIP GAJI GURU</h4>
                <p class="text-muted small mb-0">Bimbel Management System</p>
                <div class="status-paid">
                    <i class="bi bi-check-circle-fill me-1"></i> PEMBAYARAN BERHASIL
                </div>
            </div>

            <div class="receipt-box">
                <div class="receipt-item">
                    <span class="label">ID Transaksi</span>
                    <span class="value">#PAY-{{ str_pad($gaji->id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="receipt-item">
                    <span class="label">Tanggal Bayar</span>
                    <span class="value">{{ \Carbon\Carbon::parse($gaji->tanggal)->format('d M Y') }}</span>
                </div>
                
                <hr style="border-top: 2px dashed #e2e8f0; opacity: 1; margin: 15px 0;">

                <div class="receipt-item">
                    <span class="label">Nama Guru</span>
                    <span class="value">{{ $gaji->guru->nama }}</span>
                </div>
                <div class="receipt-item">
                    <span class="label">Periode</span>
                    <span class="value">{{ $gaji->bulan }} {{ $gaji->tahun }}</span>
                </div>
                <div class="receipt-item">
                    <span class="label">Tarif per Sesi</span>
                    <span class="value">Rp {{ number_format($gaji->nominal) }}</span>
                </div>
                <div class="receipt-item">
                    <span class="label">Jumlah Pertemuan</span>
                    <span class="value">{{ $gaji->jumlah_pertemuan }}x Sesi</span>
                </div>

                <hr style="border-top: 2px dashed #e2e8f0; opacity: 1; margin: 15px 0;">
                
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted fw-bold">TOTAL DITERIMA</span>
                    <span class="total-amount">Rp {{ number_format($gaji->total_gaji) }}</span>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted small italic mb-0">
                    "Terima kasih atas dedikasi Anda mengajar di Bimbimbel."
                </p>
            </div>
        </div>

        <div class="btn-group-bottom">
            <button onclick="window.print()" class="btn btn-soft btn-primary-soft shadow-sm">
                <i class="bi bi-printer"></i> Cetak Slip Gaji
            </button>
        </div>


    </div>
</div>

@include('layouts.footer')
@endsection