@extends('layouts.app')
@section('title', 'Edit Mata Kuliah')

@section('content')
<div class="card" style="max-width:500px">
    <div class="card-header"><h6 class="mb-0"><i class="fa fa-edit me-2"></i>Edit Mata Kuliah</h6></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.courses.update', $course) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $course->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Kode</label>
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                    value="{{ old('code', $course->code) }}" required>
                @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah SKS</label>
                <input type="number" name="credits" class="form-control @error('credits') is-invalid @enderror"
                    value="{{ old('credits', $course->credits) }}" min="1" max="6" required>
                @error('credits')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> Perbarui</button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
