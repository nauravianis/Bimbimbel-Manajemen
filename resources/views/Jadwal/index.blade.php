@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        background: linear-gradient(135deg, #9785be, #9785be);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
    }

    .header-top {
        background: #e3d9f8ff;
        border-radius: 25px;
        padding: 18px 30px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
    }

    h3 { font-weight: 700; }
    h6 { font-size: 14px; font-weight: 700; color: #000; }

    .card-soft {
        background: white;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .class-card {
        border-radius: 15px;
        padding: 15px;
        font-weight: 700;
        font-size: 13px;
        color: #000;
    }

    .task-item, .upcoming-item {
        font-size: 12px;
        font-weight: 500;
        padding: 10px 0;
        border-bottom: 1px solid #f1f1f5;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .badge-soft {
        background: #f0eeff;
        color: #6f5aa8;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 700;
    }

    .btn-mro {
        background: #6f5aa8;
        color: white;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 600;
        padding: 8px 16px;
    }
</style>

<div class="container py-4">

    <h3 class="fw-bold">Jadwal Harian</h3>
    <p class="text-muted">Kelola jadwal pelajaran, jam, dan guru pengajar.</p>
<div class="header-top mb-4 d-flex justify-content-end align-items-center">
    <a href="{{ route('jadwal.manage') }}" class="btn btn-mro">
        Kelola Jadwal
    </a>
</div>


    <div class="row g-4">

        {{-- LEFT --}}
        <div class="col-lg-8">

            {{-- STAT MAPEL --}}
            <div class="row g-3 mb-4">
                @foreach($mapelStat as $m)
                    <div class="col-md-4">
                        <div class="class-card bg-white shadow-sm border-start border-primary border-4">
                            {{ $m->mapel->nama_mapel }}
                            <div class="small text-muted">
                                {{ $m->total }} Jadwal
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- JADWAL HARI INI --}}
            <div class="card-soft">
                <h6 class="fw-bold mb-3">Jadwal Hari Ini</h6>

                @forelse($jadwalHariIni as $j)
<div class="task-item">
    <div>
        {{ $j->mapel->nama_mapel }}<br>
        <small class="text-muted">{{ $j->guru->nama }}</small>
    </div>

    <div class="d-flex align-items-center gap-2">
        <span class="badge-soft">
            {{ $j->jam_mulai }} - {{ $j->jam_selesai }}
        </span>

        <a href="{{ route('absen.kelas', $j->id) }}"
           class="btn btn-sm btn-mro">
            Absen
        </a>
    </div>
</div>

                @empty
                    <p class="text-muted">Tidak ada jadwal hari ini</p>
                @endforelse
            </div>
        </div>

        {{-- RIGHT --}}
        <div class="col-lg-4">

            {{-- CALENDAR --}}
            <div class="card-soft mb-4 text-center">
                <h6 class="fw-bold mb-2">{{ $now->format('F Y') }}</h6>

                <div class="d-grid" style="grid-template-columns: repeat(7,1fr);gap:5px">
                    @foreach(['Mo','Tu','We','Th','Fr','Sa','Su'] as $d)
                        <small class="fw-bold text-muted">{{ $d }}</small>
                    @endforeach

                    @php
                        $firstDay = $now->copy()->startOfMonth()->dayOfWeekIso;
                    @endphp

                    @for($i=1;$i<$firstDay;$i++)
                        <div></div>
                    @endfor

                    @for($d=1;$d<=$daysInMonth;$d++)
                        <div class="p-1 rounded {{ $d==$now->day?'bg-primary text-white':'' }}">
                            {{ $d }}
                        </div>
                    @endfor
                </div>
            </div>

            {{-- UPCOMING --}}
            <div class="card-soft">
                <h6 class="fw-bold mb-3">Jadwal Mendatang</h6>

                @foreach($upcoming as $u)
                    <div class="upcoming-item">
                        <span>
                            {{ $u->mapel->nama_mapel }}<br>
                            <small class="text-muted">{{ $u->guru->nama }}</small>
                        </span>
                        <small class="fw-bold text-primary">{{ $u->hari }}</small>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

    @include('layouts.footer')

@endsection
