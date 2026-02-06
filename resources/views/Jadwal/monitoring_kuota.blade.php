@extends('layouts.app')

@section('content')
<style>
    body { background: #f4f7fe; font-family: 'Plus Jakarta Sans', sans-serif; }
    .card-custom { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .table thead th { background: #f8f9fa; border: none; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; }
    .badge-status { padding: 6px 12px; border-radius: 10px; font-weight: 600; font-size: 11px; }
    .status-aktif { background: #e8fadf; color: #31833d; }
    .status-habis { background: #ffe5e5; color: #e53935; }
    .progress { height: 8px; border-radius: 4px; background: #eee; }
    .critical-quota { color: #d32f2f; font-weight: 700; }
</style>

<div class="container py-5">
   
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Monitoring Sisa Pertemuan</h3>
        <p class="text-muted">Pantau kuota belajar seluruh siswa secara real-time</p>
    </div>

</div>

    <div class="card card-custom">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Siswa</th>
                            <th>Paket Bimbel</th>
                            <th>Sisa Sesi</th>
                            <th>Status Paket</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporanKuota as $data)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $data->siswa->nama }}</div>
                                <small class="text-muted">ID: {{ $data->siswa->id }}</small>
                            </td>
                            <td>
                                <span class="text-dark">{{ $data->paket->nama_paket ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="{{ $data->sisa_pertemuan <= 2 ? 'critical-quota' : '' }}">
                                        {{ $data->sisa_pertemuan }} Sesi
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="badge-status {{ $data->status == 'Aktif' ? 'status-aktif' : 'status-habis' }}">
                                    {{ $data->status }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                            <a href="{{ route('jadwal.siswa', [$data->paket_bimbel_id, $data->siswa_id]) }}" 
                            class="btn btn-sm btn-light rounded-pill">
                                📅 Lihat Jadwal
                            </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    @include('layouts.footer')

@endsection