@if(session('error'))
    <div class="alert alert-danger border-0 mb-3" style="border-radius: 12px; font-size: 12px;">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
    </div>
@endif
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-soft text-center p-4">
                <h4 class="fw-bold mb-3">Scan QR Absensi</h4>
                <p class="text-muted small">Arahkan kode QR Anda ke kamera</p>
                
                {{-- Area Kamera --}}
                <div id="reader" style="width: 100%; border-radius: 15px; overflow: hidden;"></div>
                
                {{-- Form Tersembunyi untuk Kirim Data --}}
                <form id="form-absen" action="{{ route('absensi.scan') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="kode" id="kode_qr">
                </form>

                <a href="{{ route('absensi.index') }}" class="btn btn-outline-mro mt-4">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    function onScanSuccess(decodedText, decodedResult) {
        html5QrcodeScanner.clear();

        document.getElementById('kode_qr').value = decodedText;

        console.log("QR Terdeteksi: " + decodedText);

        document.getElementById('form-absen').submit();
    }

    function onScanFailure(error) {
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", 
        { 
            fps: 10, 
            qrbox: {width: 250, height: 250},
            rememberLastUsedCamera: true,
            supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
        }
    );
    
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>

<style>
    #reader {
        border: none !important;
    }
    #reader__dashboard_section_csr button {
        background: #6f5aa8 !important;
        color: white !important;
        border-radius: 10px !important;
        padding: 8px 15px !important;
        border: none !important;
        font-size: 12px !important;
    }
    .card-soft {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
</style>
@include('layouts.footer')
@endsection