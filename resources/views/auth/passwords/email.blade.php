@extends('layouts.auth')

@section('title', 'Lupa Password')

@section('content')
<div class="card mt-5">
    <div class="card-body p-4">
        <div class="text-center mb-4">
            <i class="fa fa-key fa-3x text-primary mb-2"></i>
            <h4 class="fw-bold">Lupa Password</h4>
            <p class="text-muted small">Masukkan email Anda untuk verifikasi akun</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger py-2 text-center">
                <i class="fa fa-exclamation-circle me-1"></i>{{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Email Terdaftar</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="email@gmail.com" required autofocus>
                </div>
                @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
            
            <button type="submit" class="btn btn-primary w-100 mb-3">
                Verifikasi Email <i class="fa fa-arrow-right ms-1"></i>
            </button>
            
            <div class="text-center">
                <a href="{{ route('login') }}" class="text-decoration-none small">
                    <i class="fa fa-arrow-left me-1"></i> Kembali ke Login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
