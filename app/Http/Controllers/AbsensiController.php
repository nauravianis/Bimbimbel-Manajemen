<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\AbsensiGuru;
use App\Mail\QrGuruMail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $absensi = AbsensiGuru::with(['guru'])
            ->whereDate('tanggal', today())
            ->when($search, function ($query) use ($search) {
                $query->whereHas('guru', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return view('absensi.index', compact('absensi'));
    }

    public function scanPage()
    {
        return view('absensi.scan');
    }

    public function scan(Request $request)
    {
        $request->validate(['kode' => 'required']);
        
        $kodeInput = trim($request->kode);
        $guru = Guru::where('qr_token', $kodeInput)->first();
        
        if (!$guru) {
            return redirect()->route('absensi.scanPage')
                ->with('error', 'QR Code tidak terdaftar di sistem!');
        }

        $sekarang = Carbon::now();
        $hariIni = $sekarang->toDateString();
        $jamSekarang = $sekarang->format('H:i:s');
        
        $absen = AbsensiGuru::where('guru_id', $guru->id)
                            ->whereDate('tanggal', $hariIni)
                            ->first();

        if (!$absen) {
            AbsensiGuru::create([
                'guru_id'   => $guru->id,
                'tanggal'   => $hariIni,
                'jam_masuk' => $jamSekarang,
                'status'    => 'hadir'
            ]);
            
            return redirect()->route('absensi.index')
                ->with('success', 'Berhasil Absen Masuk: ' . $guru->nama);
        } 

        if (is_null($absen->jam_keluar)) {
            $absen->update([
                'jam_keluar' => $jamSekarang
            ]);
            
            return redirect()->route('absensi.index')
                ->with('success', 'Berhasil Absen Pulang: ' . $guru->nama);
        }

        return redirect()->route('absensi.index')
            ->with('info', 'Halo ' . $guru->nama . ', Anda sudah melengkapi absensi hari ini.');
    }

    public function qrGuru()
    {
        $guru = Guru::all();
        return view('absensi.qr-guru', compact('guru'));
    }

    public function generateQr(Guru $guru)
    {
        $token = Str::random(50);
        $guru->update(['qr_token' => $token]);

        $pdfFile = 'QR-Absensi-' . $guru->id . '.pdf';
        $qrCodeSvg = QrCode::format('svg')->size(200)->generate($token);

        $pdf = Pdf::loadView('pdf.qr-guru', [
            'guru' => $guru,
            'qrCodeSvg' => $qrCodeSvg
        ]);

        Storage::disk('public')->put($pdfFile, $pdf->output());
        Mail::to($guru->email)->send(new QrGuruMail($guru, $pdfFile));

        return back()->with('success', 'QR Berhasil dikirim ke Email ' . $guru->nama);
    }
}