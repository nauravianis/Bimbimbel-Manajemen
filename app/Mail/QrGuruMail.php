<?php

namespace App\Mail;

use App\Models\Guru;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\SerializesModels;

class QrGuruMail extends Mailable
{
    use Queueable, SerializesModels;

    public $guru;
    public $pdfFile;

    public function __construct(Guru $guru, $pdfFile)
    {
        $this->guru = $guru;
        $this->pdfFile = $pdfFile;
    }

    public function build()
    {
        return $this->subject('Kartu QR Absensi Guru 🧸')
                    ->view('emails.qr-guru')
                    ->attach(Storage::disk('public')->path($this->pdfFile), [
                        'as' => 'Kartu-Absensi.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}