@extends('layouts.auth.index')

@section('content')
    <div class="card">
        <div class="card-body login-card-body rounded">
            <p class="login-box-msg fw-bold h5">{{ config('app.name') }}</p>
            <form id="forgot-password-form" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" placeholder="Please enter email" />
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    </div>
                </div>
                <div class="text-end">
                    <a href="{{ route('login') }}" class="btn btn-sm btn-link">No, go back to Login </a>
                </div>
                @error('email')
                    Error:{{ $errors->first('email') }}
                @enderror
                @session('status')
                    {{ session('status') }}
                @endsession
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary" type="submit">
                        <span class="spinner-border spinner-border-sm" hidden></span>
                        <span role="status">Send me mail</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    @vite('resources/js/pages/auth/forgot-password.js')
@endsection
