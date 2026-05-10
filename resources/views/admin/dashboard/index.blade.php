@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-4 col-lg">
        <div class="card stat-card border-primary">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-primary bg-opacity-10 rounded p-3">
                    <i class="fa fa-users fa-lg text-primary"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $stats['users'] }}</div>
                    <div class="text-muted small">Total User</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg">
        <div class="card stat-card border-success">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 rounded p-3">
                    <i class="fa fa-book fa-lg text-success"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $stats['courses'] }}</div>
                    <div class="text-muted small">Mata Kuliah</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg">
        <div class="card stat-card border-info">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-info bg-opacity-10 rounded p-3">
                    <i class="fa fa-door-open fa-lg text-info"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $stats['rooms'] }}</div>
                    <div class="text-muted small">Ruangan</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg">
        <div class="card stat-card border-warning">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-warning bg-opacity-10 rounded p-3">
                    <i class="fa fa-calendar-alt fa-lg text-warning"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $stats['schedules'] }}</div>
                    <div class="text-muted small">Jadwal</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg">
        <div class="card stat-card border-danger">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-danger bg-opacity-10 rounded p-3">
                    <i class="fa fa-clipboard-list fa-lg text-danger"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">{{ $stats['enrollments'] }}</div>
                    <div class="text-muted small">Enrollment</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h6 class="fw-semibold mb-3">Akses Cepat</h6>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary btn-sm">
                <i class="fa fa-user-plus me-1"></i> Tambah User
            </a>
            <a href="{{ route('admin.courses.create') }}" class="btn btn-outline-success btn-sm">
                <i class="fa fa-plus me-1"></i> Tambah Mata Kuliah
            </a>
            <a href="{{ route('admin.rooms.create') }}" class="btn btn-outline-info btn-sm">
                <i class="fa fa-plus me-1"></i> Tambah Ruangan
            </a>
            <a href="{{ route('admin.schedules.create') }}" class="btn btn-outline-warning btn-sm">
                <i class="fa fa-plus me-1"></i> Buat Jadwal
            </a>
        </div>
    </div>
</div>
@endsection
