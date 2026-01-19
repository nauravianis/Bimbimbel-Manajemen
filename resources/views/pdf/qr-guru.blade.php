<!DOCTYPE html>
<html>
<head>
    <title>Kartu Absensi</title>
    <style>
        .card { border: 1px solid #000; padding: 20px; text-align: center; width: 300px; }
        .qr { margin-top: 10px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>KARTU ABSENSI</h2>
        <p><strong>{{ $guru->nama }}</strong></p>
        <div class="qr">
            <img src="data:image/svg+xml;base64,<?php echo base64_encode($qrCodeSvg); ?>" width="200">
        </div>
        <p>Tunjukkan QR ini saat masuk & pulang</p>
    </div>
</body>
</html>