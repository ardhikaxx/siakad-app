@extends('layouts.app')
@section('title', 'Dashboard Dosen')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card stat-card border-purple h-100" style="border-left-color:#7b1fa2!important">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded p-3" style="background:rgba(123,31,162,0.1)">
                    <i class="fa fa-calendar-alt fa-lg" style="color:#7b1fa2"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $totalJadwal }}</div>
                    <div class="text-muted small">Jadwal Mengajar</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card stat-card border-info h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-info bg-opacity-10 rounded p-3">
                    <i class="fa fa-users fa-lg text-info"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $totalMahasiswa }}</div>
                    <div class="text-muted small">Total Mahasiswa</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Selamat datang, {{ auth()->user()->name }}!</h5>
        <p class="text-muted mb-3">NIP: <code>{{ auth()->user()->identifier }}</code></p>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('dosen.schedules') }}" class="btn btn-primary">
                <i class="fa fa-calendar-alt me-1"></i> Lihat Jadwal Mengajar
            </a>
        </div>
    </div>
</div>
@endsection
