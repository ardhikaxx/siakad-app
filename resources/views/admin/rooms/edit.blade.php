@extends('layouts.app')
@section('title', 'Edit Ruangan')

@section('content')
<div class="card" style="max-width:450px">
    <div class="card-header"><h6 class="mb-0"><i class="fa fa-edit me-2"></i>Edit Ruangan</h6></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.rooms.update', $room) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Ruangan</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $room->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Kapasitas</label>
                <input type="number" name="capacity" class="form-control @error('capacity') is-invalid @enderror"
                    value="{{ old('capacity', $room->capacity) }}" min="1" required>
                @error('capacity')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> Perbarui</button>
                <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
