@extends('layouts.app')
@section('title', 'Manajemen User')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0"><i class="fa fa-users me-2"></i>Daftar User</h6>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-plus me-1"></i> Tambah User
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIM/NIP</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $loop->iteration + ($users->currentPage()-1) * $users->perPage() }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><code>{{ $user->identifier }}</code></td>
                        <td>
                            <span class="badge bg-{{ $user->role->name === 'admin' ? 'primary' : ($user->role->name === 'dosen' ? 'purple' : 'warning') }} text-capitalize"
                                style="{{ $user->role->name === 'dosen' ? 'background:#7b1fa2!important' : '' }}">
                                {{ $user->role->name }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $user->is_active ? 'success' : 'secondary' }}">
                                {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger btn-delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data user.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($users->hasPages())
    <div class="card-footer">{{ $users->links() }}</div>
    @endif
</div>
@endsection
