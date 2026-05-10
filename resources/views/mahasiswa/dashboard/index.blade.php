@extends('layouts.app')
@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card stat-card" style="border-left:4px solid #bf360c">
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
    <div class="col-md-6">
        <div class="card stat-card border-success">
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
<div class="card">
    <div class="card-body">
        <p class="mb-1">Selamat datang, <strong>{{ auth()->user()->name }}</strong>.</p>
        <p class="text-muted mb-3">NIM: {{ auth()->user()->identifier }}</p>
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
@endsection
