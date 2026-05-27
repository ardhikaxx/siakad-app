@extends('layouts.app')
@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-5">
        <div class="card">
            <div class="card-header"><h6 class="mb-0"><i class="fa fa-book me-2"></i>Tambah Mata Kuliah</h6></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.courses.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Mata Kuliah</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode</label>
                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                            value="{{ old('code') }}" placeholder="cth: CS101" required>
                        @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah SKS</label>
                        <input type="number" name="credits" class="form-control @error('credits') is-invalid @enderror"
                            value="{{ old('credits') }}" min="1" max="6" required>
                        @error('credits')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Semester</label>
                        <input type="text" name="semester" class="form-control @error('semester') is-invalid @enderror"
                            value="{{ old('semester') }}" placeholder="cth: 1, 2, atau Ganjil" required>
                        @error('semester')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> Simpan</button>
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
