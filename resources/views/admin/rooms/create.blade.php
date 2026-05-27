@extends('layouts.app')
@section('title', 'Tambah Ruangan')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-5">
        <div class="card">
            <div class="card-header"><h6 class="mb-0"><i class="fa fa-door-open me-2"></i>Tambah Ruangan</h6></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.rooms.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Ruangan</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" placeholder="cth: Ruang A1" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kapasitas</label>
                        <input type="number" name="capacity" class="form-control @error('capacity') is-invalid @enderror"
                            value="{{ old('capacity') }}" min="1" required>
                        @error('capacity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> Simpan</button>
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
