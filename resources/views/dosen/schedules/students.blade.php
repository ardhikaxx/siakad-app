@extends('layouts.app')
@section('title', 'Daftar Peserta')

@section('content')
<div class="mb-3">
    <a href="{{ route('dosen.schedules') }}" class="btn btn-sm btn-outline-secondary">
        <i class="fa fa-arrow-left me-1"></i> Kembali
    </a>
</div>
<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <h6 class="fw-bold mb-1">{{ $schedule->course->name }} <span class="badge bg-secondary">{{ $schedule->course->code }}</span></h6>
                <div class="text-muted small">
                    <i class="fa fa-door-open me-1"></i>{{ $schedule->room->name }} &nbsp;|&nbsp;
                    <i class="fa fa-calendar me-1"></i>{{ $schedule->day }}, {{ substr($schedule->start_time,0,5) }}–{{ substr($schedule->end_time,0,5) }} &nbsp;|&nbsp;
                    {{ $schedule->semester }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
        <h6 class="mb-0"><i class="fa fa-clipboard-list me-2"></i>Mahasiswa Terdaftar ({{ $schedule->enrollments->count() }})</h6>
        <div class="btn-group">
            <button class="btn btn-primary btn-sm active">Daftar Mahasiswa</button>
            <a href="{{ route('dosen.meetings.index', $schedule) }}" class="btn btn-outline-secondary btn-sm">Daftar Pertemuan</a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 text-nowrap align-middle">
                <thead class="table-dark">
                    <tr><th>#</th><th>NIM</th><th>Nama Mahasiswa</th><th>Terdaftar Sejak</th></tr>
                </thead>
                <tbody>
                    @forelse($schedule->enrollments as $enrollment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code>{{ $enrollment->student->identifier }}</code></td>
                        <td>{{ $enrollment->student->name }}</td>
                        <td>{{ $enrollment->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">Belum ada mahasiswa terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
