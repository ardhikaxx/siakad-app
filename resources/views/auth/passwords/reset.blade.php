@extends('layouts.auth')

@section('title', 'Ubah Password Baru')

@section('content')
<div class="card mt-5">
    <div class="card-body p-4">
        <div class="text-center mb-4">
            <i class="fa fa-user-lock fa-3x text-primary mb-2"></i>
            <h4 class="fw-bold">Password Baru</h4>
            <p class="text-muted small">Silakan masukkan password baru Anda</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-3 text-center">
                <span class="badge bg-light text-dark border p-2">
                    <i class="fa fa-envelope me-1"></i> {{ $email }}
                </span>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password Baru</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required autofocus>
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
                @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••" required>
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password_confirmation">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <button type="submit" class="btn btn-success w-100">
                Ubah Password Sekarang
            </button>
        </form>
    </div>
</div>
@endsection
