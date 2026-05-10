@extends('layouts.app')
@section('title', 'Tambah Jadwal')

@section('content')
<div class="card" style="max-width:600px">
    <div class="card-header"><h6 class="mb-0"><i class="fa fa-calendar-alt me-2"></i>Tambah Jadwal Baru</h6></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.schedules.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Mata Kuliah</label>
                <select name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($courses as $c)
                        <option value="{{ $c->id }}" {{ old('course_id') == $c->id ? 'selected' : '' }}>
                            {{ $c->code }} — {{ $c->name }}
                        </option>
                    @endforeach
                </select>
                @error('course_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Dosen</label>
                <select name="lecturer_id" class="form-select @error('lecturer_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Dosen --</option>
                    @foreach($lecturers as $l)
                        <option value="{{ $l->id }}" {{ old('lecturer_id') == $l->id ? 'selected' : '' }}>
                            {{ $l->name }} ({{ $l->identifier }})
                        </option>
                    @endforeach
                </select>
                @error('lecturer_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Ruangan</label>
                <select name="room_id" class="form-select @error('room_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Ruangan --</option>
                    @foreach($rooms as $r)
                        <option value="{{ $r->id }}" {{ old('room_id') == $r->id ? 'selected' : '' }}>
                            {{ $r->name }} ({{ $r->capacity }} orang)
                        </option>
                    @endforeach
                </select>
                @error('room_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Hari</label>
                    <select name="day" class="form-select @error('day') is-invalid @enderror" required>
                        <option value="">-- Pilih Hari --</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $day)
                            <option value="{{ $day }}" {{ old('day') == $day ? 'selected' : '' }}>{{ $day }}</option>
                        @endforeach
                    </select>
                    @error('day')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Semester</label>
                    <input type="text" name="semester" class="form-control @error('semester') is-invalid @enderror"
                        value="{{ old('semester') }}" placeholder="cth: Ganjil 2024/2025" required>
                    @error('semester')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror"
                        value="{{ old('start_time') }}" required>
                    @error('start_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jam Selesai</label>
                    <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror"
                        value="{{ old('end_time') }}" required>
                    @error('end_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> Simpan</button>
                <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
