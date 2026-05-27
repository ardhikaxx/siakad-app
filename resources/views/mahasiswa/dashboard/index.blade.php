@extends('layouts.app')
@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-12 col-md-6">
        <div class="card stat-card shadow-sm" style="border-left:4px solid #bf360c">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded p-3" style="background:rgba(191,54,12,0.1)">
                    <i class="fa fa-clipboard-list fa-lg" style="color:#bf360c"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $totalEnrollment }}</div>
                    <div class="text-muted small">Mata Kuliah Diambil</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card stat-card border-success shadow-sm" style="border-left:4px solid #198754">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 rounded p-3">
                    <i class="fa fa-book fa-lg text-success"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $totalSks }}</div>
                    <div class="text-muted small">Total SKS</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <div>
                <h5 class="mb-1">Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</h5>
                <p class="text-muted mb-0">NIM: {{ auth()->user()->identifier }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('mahasiswa.schedules') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fa fa-calendar-alt me-1"></i> Lihat Jadwal
                </a>
                <a href="{{ route('mahasiswa.enrollments.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-clipboard-list me-1"></i> KRS Saya
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
