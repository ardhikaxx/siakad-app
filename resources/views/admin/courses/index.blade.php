@extends('layouts.app')
@section('title', 'Mata Kuliah')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0"><i class="fa fa-book me-2"></i>Daftar Mata Kuliah</h6>
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-plus me-1"></i> Tambah
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>Kode</th><th>Nama Mata Kuliah</th><th>SKS</th><th>Semester</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                <tr>
                    <td>{{ $loop->iteration + ($courses->currentPage()-1) * $courses->perPage() }}</td>
                    <td><span class="badge bg-secondary">{{ $course->code }}</span></td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->credits }} SKS</td>
                    <td>Semester {{ $course->semester }}</td>
                    <td>
                        <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-outline-warning">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger btn-delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada mata kuliah.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($courses->hasPages())
    <div class="card-footer">{{ $courses->links() }}</div>
    @endif
</div>
@endsection
