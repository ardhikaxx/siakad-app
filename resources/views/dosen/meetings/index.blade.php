@extends('layouts.app')
@section('title', 'Daftar Pertemuan')

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
                    <i class="fa fa-calendar me-1"></i>{{ $schedule->day }}, {{ substr($schedule->start_time,0,5) }}–{{ substr($schedule->end_time,0,5) }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="fa fa-plus me-2"></i>Buat Pertemuan Baru</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('dosen.meetings.store', $schedule) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase">Judul Pertemuan</label>
                        <input type="text" name="title" class="form-control" placeholder="cth: Pertemuan 1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase">Tanggal</label>
                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-uppercase">Keterangan (Opsional)</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Topik atau materi pertemuan..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa fa-save me-1"></i> Simpan Pertemuan
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                <h6 class="mb-0"><i class="fa fa-list me-2"></i>Riwayat Pertemuan</h6>
                <div class="btn-group">
                    <a href="{{ route('dosen.schedules.students', $schedule) }}" class="btn btn-outline-secondary btn-sm">Daftar Mahasiswa</a>
                    <button class="btn btn-primary btn-sm active">Daftar Pertemuan</button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 text-nowrap align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th width="50">#</th>
                                <th>Pertemuan</th>
                                <th>Tanggal</th>
                                <th width="150" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($meetings as $meeting)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="fw-bold text-primary">{{ $meeting->title }}</div>
                                    @if($meeting->description)
                                        <small class="text-muted">{{ $meeting->description }}</small>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($meeting->date)->format('d M Y') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('dosen.attendances.index', [$schedule, $meeting]) }}" class="btn btn-sm btn-info text-white" title="Input Presensi">
                                            <i class="fa fa-user-check me-1"></i> Presensi
                                        </a>
                                        <form action="{{ route('dosen.meetings.destroy', [$schedule, $meeting]) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger btn-delete" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">Belum ada pertemuan yang dibuat.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($meetings->hasPages())
                <div class="card-footer">{{ $meetings->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
