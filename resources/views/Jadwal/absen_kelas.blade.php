@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { background: #9785be; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; }
    .card-soft { background: white; border-radius: 25px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    .btn-mro { background: #6f5aa8; color: white; border-radius: 15px; font-weight: 600; padding: 12px 25px; border: none; transition: 0.3s; }
    .btn-mro:hover { background: #5a4890; color: white; }
    .siswa-row { border-bottom: 1px solid #f1f1f5; padding: 15px 0; }
    .siswa-row:hover { background: #fcfaff; }
    .badge-kuota { background: #f0eeff; color: #6f5aa8; padding: 5px 12px; border-radius: 10px; font-weight: 700; font-size: 11px; }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 15px;">✅ {{ session('success') }}</div>
            @endif

            <div class="card-soft">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                       <h4 class="fw-bold mb-1">{{ $jadwal->mapel->nama_mapel }}</h4>
                       <p class="text-muted mb-0">{{ $jadwal->paketBimbel->nama_paket }} • {{ $jadwal->hari }}, {{ $jadwal->jam_mulai }}</p>
                    </div>
                    <a href="{{ route('jadwal.index') }}" class="text-muted text-decoration-none small">← Kembali</a>
                </div>

                <form action="{{ route('absen.simpan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="jadwal_mengajar_id" value="{{ $jadwal->id }}">
                    <input type="hidden" name="tanggal" value="{{ now()->toDateString() }}">

                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Daftar Siswa</h6>
                        @forelse($siswa as $s)
                        <div class="siswa-row d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <input type="hidden" name="siswa_id[]" value="{{ $s->id }}">
                                <div>
                                    <div class="fw-bold">{{ $s->nama }}</div>
                                    <div class="small text-muted">ID: {{ $s->id }}</div>
                                </div>
                            </div>
                            
<div class="d-flex align-items-center gap-3">
    @php 
$p = $s->paketSiswa
    ->where('paket_bimbel_id', $jadwal->paket_bimbel_id)
    ->where('status', 'aktif')
    ->first();

    @endphp
    
    <span class="badge-kuota">Sisa: {{ $p ? $p->sisa_pertemuan : 0 }} Sesi</span>

    <select name="absen[{{ $s->id }}]" class="form-select form-select-sm" style="width: 110px;">
        <option value="Hadir">Hadir</option>
        <option value="Izin">Izin</option>
        <option value="Sakit">Sakit</option>
        <option value="Alfa">Alfa</option>
    </select>
</div>                        </div>
                        @empty
                        <div class="text-center py-5"><p class="text-muted">Belum ada siswa terdaftar.</p></div>
                        @endforelse
                    </div>

                    @if($siswa->count() > 0)
                    <button type="submit" class="btn-mro w-100 shadow-sm" onclick="return confirm('Simpan absensi sekarang?')">
                        Simpan Absen Masal
                    </button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection