@extends('layouts.auth.index')

@section('content')
    <div class="card">
        <div class="card-body login-card-body rounded">
            <p class="login-box-msg fw-bold h5">{{ config('app.name') }}</p>
            <form id="login-form">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" />
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" autocomplete />
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary" type="submit">
                        <span class="spinner-border spinner-border-sm" hidden></span>
                        <span role="status">Sign In</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    @vite('resources/js/pages/auth/login.js')
@endsection
