@extends('layouts.app')
@section('title', 'Input Presensi')

@section('content')
<div class="mb-3">
    <a href="{{ route('dosen.meetings.index', $schedule) }}" class="btn btn-sm btn-outline-secondary">
        <i class="fa fa-arrow-left me-1"></i> Kembali ke Daftar Pertemuan
    </a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <h6 class="fw-bold mb-1">{{ $schedule->course->name }} ({{ $meeting->title }})</h6>
                <div class="text-muted small">
                    <i class="fa fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($meeting->date)->format('d F Y') }} &nbsp;|&nbsp;
                    <i class="fa fa-door-open me-1"></i>{{ $schedule->room->name }}
                </div>
            </div>
            <div>
                <span class="badge bg-primary">Input Presensi</span>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        <h6 class="mb-0"><i class="fa fa-user-check me-2"></i>Daftar Kehadiran Mahasiswa</h6>
    </div>
    <div class="card-body p-0">
        <form action="{{ route('dosen.attendances.update', [$schedule, $meeting]) }}" method="POST">
            @csrf @method('PUT')
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th class="text-center" width="300">Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $attendance)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><code>{{ $attendance->student->identifier }}</code></td>
                            <td>{{ $attendance->student->name }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="attendances[{{ $attendance->id }}]" 
                                            id="h_{{ $attendance->id }}" value="Hadir" {{ $attendance->status == 'Hadir' ? 'checked' : '' }}>
                                        <label class="form-check-label text-success fw-bold" for="h_{{ $attendance->id }}">Hadir</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="attendances[{{ $attendance->id }}]" 
                                            id="i_{{ $attendance->id }}" value="Ijin" {{ $attendance->status == 'Ijin' ? 'checked' : '' }}>
                                        <label class="form-check-label text-warning fw-bold" for="i_{{ $attendance->id }}">Ijin</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="attendances[{{ $attendance->id }}]" 
                                            id="a_{{ $attendance->id }}" value="Alpa" {{ $attendance->status == 'Alpa' ? 'checked' : '' }}>
                                        <label class="form-check-label text-danger fw-bold" for="a_{{ $attendance->id }}">Alpa</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Tidak ada data mahasiswa.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white text-end">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fa fa-save me-1"></i> Simpan Presensi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
