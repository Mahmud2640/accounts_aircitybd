@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Basic -->
        <div class="block">
            <div class="block-content block-content-full">
                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                	@csrf
                    <div class="row push">
                        <div class="col-lg-8 col-xl-8">
                            <div class="form-group">
                                <label for="example-text-input">Name</label>
                                <input required type="text" class="form-control" id="example-text-input" name="name" placeholder="Name Input">
                            </div>
                            <div class="form-group">
                                <label for="example-email-input">Email</label>
                                <input type="email" class="form-control" id="example-email-input" name="email" placeholder="Login Email Input">
                            </div>
                            <div class="form-group">
                                <label>Branch</label>
                                <select class="custom-select" id="example-select-custom" name="branch_id" required>
                                    <option value="0">Please select Branch</option>
                                    @foreach ($branchs as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="example-password-input">Salary</label>
                                <input type="Number" stop="0.01" class="form-control" id="example-password-input" name="salary" placeholder="Employee salary">
                            </div>
                            <div class="form-group">
                                <label for="example-password-input">password</label>
                                <input type="password" stop="0.01" class="form-control" id="example-password-input" name="password" placeholder="Login password">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="custom-select" id="example-select-custom" name="role" required>
                                    <option value="admin">Admin</option>
                                    <option selected value="author">Employee</option>
                                    <option value="branch_manager">Branch Manager</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="example-password-input">Image</label>
                                <input type="file" class="form-control" id="example-password-input" name="image">
                            </div>
                            <div class="form-group ml-4">
                                <input class="form-check-input" type="checkbox" value="1" id="example-checkbox-default1" checked name="status">
                                <label class="form-check-label" for="example-checkbox-default1">Active</label>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Basic -->
    </div>
@endsection