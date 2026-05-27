@extends('layouts.app')
@section('title', 'KRS Saya')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
        <h6 class="mb-0"><i class="fa fa-clipboard-list me-2"></i>KRS — Mata Kuliah Saya</h6>
        <a href="{{ route('mahasiswa.schedules') }}" class="btn btn-sm btn-outline-primary">
            <i class="fa fa-plus me-1"></i> Tambah Mata Kuliah
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 text-nowrap">
                <thead class="table-dark">
                    <tr><th>#</th><th>Mata Kuliah</th><th>Dosen</th><th>Ruangan</th><th>Hari & Jam</th><th>Semester</th><th>SKS</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @php $totalSks = 0; @endphp
                    @forelse($enrollments as $e)
                    @php $totalSks += $e->schedule->course->credits; @endphp
                    <tr>
                        <td>{{ $loop->iteration + ($enrollments->currentPage()-1) * $enrollments->perPage() }}</td>
                        <td>
                            <div class="fw-semibold">{{ $e->schedule->course->name }}</div>
                            <small class="text-muted">{{ $e->schedule->course->code }}</small>
                        </td>
                        <td>{{ $e->schedule->lecturer->name }}</td>
                        <td>{{ $e->schedule->room->name }}</td>
                        <td>
                            <span class="badge bg-info text-dark">{{ $e->schedule->day }}</span><br>
                            <small>{{ substr($e->schedule->start_time,0,5) }}–{{ substr($e->schedule->end_time,0,5) }}</small>
                        </td>
                        <td><small>{{ $e->schedule->semester }}</small></td>
                        <td>{{ $e->schedule->course->credits }} SKS</td>
                        <td>
                            <form method="POST" action="{{ route('mahasiswa.enrollments.destroy', $e->schedule) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger btn-delete">
                                    <i class="fa fa-times"></i> Batalkan
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">Belum ada mata kuliah yang diambil.</td></tr>
                    @endforelse
                </tbody>
                @if($enrollments->count() > 0)
                <tfoot>
                    <tr class="table-light fw-semibold">
                        <td colspan="6" class="text-end">Total SKS (halaman ini):</td>
                        <td>{{ $totalSks }} SKS</td>
                        <td></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
    @if($enrollments->hasPages())
    <div class="card-footer">{{ $enrollments->links() }}</div>
    @endif
</div>
@endsection
