@extends('layouts.app')
@section('title', 'Jadwal Kuliah')

@section('content')
{{-- Filter Semester --}}
<div class="card shadow-sm mb-3">
    <div class="card-body py-2">
        <form method="GET" class="d-flex flex-wrap align-items-center gap-2">
            <label class="form-label mb-0 fw-semibold">Semester:</label>
            <select name="semester" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                <option value="">Semua</option>
                @foreach($semesters as $sem)
                    <option value="{{ $sem }}" {{ $semester == $sem ? 'selected' : '' }}>{{ $sem }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header">
        <h6 class="mb-0"><i class="fa fa-calendar-alt me-2"></i>Jadwal Tersedia</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 text-nowrap">
                <thead class="table-dark">
                    <tr><th>Mata Kuliah</th><th>Dosen</th><th>Ruangan</th><th>Hari & Jam</th><th>Semester</th><th>Peserta</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($schedules as $s)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $s->course->name }}</div>
                            <small class="text-muted">{{ $s->course->code }} · {{ $s->course->credits }} SKS</small>
                        </td>
                        <td>{{ $s->lecturer->name }}</td>
                        <td>{{ $s->room->name }}</td>
                        <td>
                            <span class="badge bg-info text-dark">{{ $s->day }}</span><br>
                            <small>{{ substr($s->start_time,0,5) }}–{{ substr($s->end_time,0,5) }}</small>
                        </td>
                        <td><small>{{ $s->semester }}</small></td>
                        <td><span class="badge bg-secondary">{{ $s->enrollments_count }}</span></td>
                        <td>
                            @if($enrolledIds->contains($s->id))
                                <form method="POST" action="{{ route('mahasiswa.enrollments.destroy', $s) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger btn-delete">
                                        <i class="fa fa-times me-1"></i> Batalkan
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('mahasiswa.enrollments.store', $s) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success">
                                        <i class="fa fa-plus me-1"></i> Daftar
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Tidak ada jadwal tersedia.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($schedules->hasPages())
    <div class="card-footer">{{ $schedules->appends(request()->query())->links() }}</div>
    @endif
</div>
@endsection
