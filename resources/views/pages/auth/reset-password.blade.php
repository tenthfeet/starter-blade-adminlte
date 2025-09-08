@extends('layouts.auth.index')

@section('content')
    <div class="card">
        <div class="card-body login-card-body rounded">
            <p class="login-box-msg fw-bold h5">Reset Password</p>
            <form id="reset-password-form" method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <input type="hidden" name="email" value="{{ $request->email }}">
                <div class="form-group">
                    <label class="form-label">New password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" autocomplete />
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>
                    @error('password')
                        {{ $errors->first('password') }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Confirm (Repeat new) password</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Repeat new password" autocomplete />
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary" type="submit">
                        <span class="spinner-border spinner-border-sm" hidden></span>
                        <span role="status">Set new password</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
