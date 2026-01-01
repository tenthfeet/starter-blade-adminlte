@extends('layouts.main.index')

@section('page-title', 'Profile')

@section('breadcrumbs')
    <x-layouts.breadcrumbs :links="[['label' => 'Profile']]" />
@endsection

@section('content')
    <div class="card mb-3">
        <div class="card-header d-flex align-items-center">
            <h6 class="m-0">Details</h6>
        </div>
        <div class="card-body">
            <form id="profile-form">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" value="{{ $user->email }}" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label required">Name</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label required">Mobile No.</label>
                        <input type="text" class="form-control" value="{{ $user->mobile_no }}" name="mobile_no">
                    </div>
                </div>
                <div class="d-flex">
                    <button class="btn btn-primary me-auto mb-3" type="submit">
                        <span class="spinner-border spinner-border-sm" hidden></span>
                        <span role="status">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header d-flex align-items-center">
            <h6 class="m-0">Change Password</h6>
        </div>
        <div class="card-body">
            <form id="password-form">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="form-label required">Current Password</label>
                        <input type="password" class="form-control" value="" name="current_password" autocomplete>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label required">New Password</label>
                        <input type="password" class="form-control" value="" name="password" autocomplete>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-label required">Confirm the new Password</label>
                        <input type="password" class="form-control" value="" name="password_confirmation" autocomplete>
                    </div>
                </div>
                <div class="d-flex">
                    <button class="btn btn-primary me-auto mb-3" type="submit">
                        <span class="spinner-border spinner-border-sm" hidden></span>
                        <span role="status">Change Password</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    @vite('resources/js/pages/user-management/profile.js')
@endsection
