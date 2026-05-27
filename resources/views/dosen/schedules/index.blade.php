@extends('layouts.app')
@section('title', 'Jadwal Mengajar')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="mb-0"><i class="fa fa-calendar-alt me-2"></i>Jadwal Mengajar Saya</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 text-nowrap align-middle">
                <thead class="table-dark">
                    <tr><th>#</th><th>Mata Kuliah</th><th>Ruangan</th><th>Hari</th><th>Jam</th><th>Semester</th><th>Peserta</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($schedules as $s)
                    <tr>
                        <td>{{ $loop->iteration + ($schedules->currentPage()-1) * $schedules->perPage() }}</td>
                        <td>
                            <div class="fw-semibold">{{ $s->course->name }}</div>
                            <small class="text-muted">{{ $s->course->code }} · {{ $s->course->credits }} SKS</small>
                        </td>
                        <td>{{ $s->room->name }}</td>
                        <td><span class="badge bg-info text-dark">{{ $s->day }}</span></td>
                        <td>{{ substr($s->start_time,0,5) }} – {{ substr($s->end_time,0,5) }}</td>
                        <td><small>{{ $s->semester }}</small></td>
                        <td><span class="badge bg-secondary">{{ $s->enrollments->count() }} mhs</span></td>
                        <td>
                            <a href="{{ route('dosen.schedules.students', $s) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-users me-1"></i> Peserta
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">Belum ada jadwal mengajar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($schedules->hasPages())
    <div class="card-footer">{{ $schedules->links() }}</div>
    @endif
</div>
@endsection
