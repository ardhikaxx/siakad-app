@extends('layouts.app')
@section('title', 'Ruangan')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0"><i class="fa fa-door-open me-2"></i>Daftar Ruangan</h6>
        <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-plus me-1"></i> Tambah
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>Nama Ruangan</th><th>Kapasitas</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($rooms as $room)
                <tr>
                    <td>{{ $loop->iteration + ($rooms->currentPage()-1) * $rooms->perPage() }}</td>
                    <td>{{ $room->name }}</td>
                    <td>{{ $room->capacity }} orang</td>
                    <td>
                        <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-outline-warning">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.rooms.destroy', $room) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger btn-delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-4">Belum ada ruangan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($rooms->hasPages())
    <div class="card-footer">{{ $rooms->links() }}</div>
    @endif
</div>
@endsection
