    @extends('layouts.main.index')

    @section('page-title', 'User')

    @section('breadcrumbs')
        <x-layouts.breadcrumbs :links="[['label' => 'Users']]" />
    @endsection

    @section('content')
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h6 class="m-0">List of User</h6>
                <button id="add-user" class="btn btn-sm btn-primary ms-auto py-0">
                    <i class="bi bi-plus-lg me-2"></i>User
                </button>
            </div>
            <div class="card-body">
                <table id="users" class="table table-sm table-bordered table-hover table-stripped m-0">
                    <thead>
                        <tr class="table-primary">
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="user-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="user-form">
                            @method('PATCH')
                            <input type="hidden" name="id" class="reset" value="">
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control reset" name="name" required>
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control reset" name="email" required>
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label class="form-label">Mobile No <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">+ 91</span>
                                        <input type="text" class="form-control reset" name="mobile_no">
                                    </div>
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select reset" name="status" id="status" required>
                                        {!! generate_options($statuses, [], '--Select Status--') !!}
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-primary me-auto mb-3" type="submit">
                                    <span class="spinner-border spinner-border-sm" hidden></span>
                                    <span role="status">Submit</span>
                                </button>
                            </div>
                        </form>

                        <div class="note">
                            Note: Default password will be <b>password#321</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        @vite('resources/js/pages/user-management/users.js')
    @endsection
