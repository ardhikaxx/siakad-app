@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="card mt-5">
    <div class="card-body p-4">
        <div class="text-center mb-4">
            <i class="fa fa-graduation-cap fa-3x text-primary mb-2"></i>
            <h4 class="fw-bold">SIAKAD</h4>
            <p class="text-muted small">Sistem Informasi Akademik</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger py-2">
                <i class="fa fa-exclamation-circle me-1"></i>{{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="email@siakad.com" required autofocus>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div class="form-check mb-0">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>
                <a href="{{ route('password.request') }}" class="text-decoration-none small">Lupa Password?</a>
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="fa fa-sign-in-alt me-1"></i> Masuk
            </button>
        </form>
    </div>
</div>
@endsection
