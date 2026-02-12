@extends('layouts.app')

@section('content')
<style>
    body { 
        background: #f4f7fe; 
        font-family: 'Plus Jakarta Sans', sans-serif; 
    }

    .card-custom { 
        border: none; 
        border-radius: 20px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
    }

    .table thead th { 
        background: #f8f9fa; 
        border: none; 
        color: #6c757d; 
        font-weight: 600; 
        text-transform: uppercase; 
        font-size: 11px; 
        letter-spacing: 0.5px; 
    }

    .table tbody td {
        font-size: 13px;
        color: #2c2c2c;
        font-weight: 500;
    }

    .badge-status {
        padding: 6px 14px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 11px;
    }

    .status-hadir { background: #e8fadf; color: #31833d; }
    .status-izin  { background: #fff4e5; color: #ef6c00; }
    .status-alpha { background: #ffe5e5; color: #d32f2f; }

    .filter-box select,
    .filter-box button {
        border-radius: 14px;
        font-size: 12px;
        font-weight: 600;
        border: none;
        padding: 10px 14px;
    }

    .filter-box button {
        background: #6f5aa8;
        color: #fff;
    }
</style>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Rekap Kehadiran Guru</h3>
            <p class="text-muted">Monitoring kehadiran dan jam mengajar guru</p>
        </div>
    </div>

    <div class="card card-custom mb-4">
        <div class="card-body">
            <form method="GET" class="row g-2 filter-box">
                <div class="col-md-3">
                    <select name="bulan" class="form-control">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="tahun" class="form-control">
                        @for ($y = now()->year; $y >= now()->year - 5; $y--)
                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-custom">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Guru</th>
                            <th>Jumlah kehadiran</th>
                            <th>Jumlah Tidak Hadir</th>
                            <th>Total Jam</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($guru as $g)
                    <tr>
                        <td class="ps-4 fw-bold text-dark">{{ $g->nama }}</td>

                        <td>
                            <span class="badge-status status-hadir">
                                {{ $g->hadir }}
                            </span>
                        </td>

                        <td>
                            <span class="badge-status status-izin">
                                {{ $g->tidak_hadir }}
                            </span>
                        </td>

                        <td class="fw-semibold">
                            {{ $g->total_jam }} jam
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
