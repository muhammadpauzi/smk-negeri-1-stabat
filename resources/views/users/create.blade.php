@extends('layouts.app')

@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center mb-3">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    User
                </div>
                <h2 class="page-title">
                    Create New User
                </h2>
            </div>
        </div>

        <form action="{{ route('dashboard.users.store') }}" method="post">
            @csrf

            <div class="row">
                <div class="col">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Form Create User</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name of user <span class="text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="username">Username <span class="text-danger">*</span></label>
                                        <input type="text" id="username" class="form-control" name="username" value="{{ old('username') }}">
                                        <ul class="text-muted mt-2 block">
                                            <li>Can only contain letters, numbers, dashs and underscores</li>
                                        </ul>
                                        @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email Address <span class="text-danger">*</span></label>
                                        <input type="text" id="email" class="form-control" name="email" value="{{ old('email') }}">
                                        <ul class="text-muted mt-2 block">
                                            <li>Make sure the email is active</li>
                                        </ul>
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="role">Role <span class="text-danger">*</span></label>
                                        <select class="form-select" name="role" id="role">
                                            @foreach($roles as $role)
                                            <option value="{{ $role }}">{{ Str::ucfirst($role) }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-flat">
                                            <input type="password" class="form-control" autocomplete="off" name="password" id="password">
                                            <span class="input-group-text">
                                                <a href="#" data-input-password-target="#password" class="btn-show-password" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <circle cx="12" cy="12" r="2" />
                                                        <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                                    </svg>
                                                </a>
                                            </span>
                                        </div>
                                        <ul class="text-muted mt-2 block">
                                            <li>Must be at least 5 characters in length</li>
                                            <li>Must contain at least one lowercase letter</li>
                                            <li>Must contain at least one uppercase letter</li>
                                            <li>Must contain a special character</li>
                                        </ul>
                                        @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password_confirm">Confirm Password <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-flat">
                                            <input type="password" class="form-control" autocomplete="off" name="password_confirm" id="password-confirm">
                                            <span class="input-group-text">
                                                <a href="#" data-input-password-target="#password-confirm" class="btn-show-password" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <circle cx="12" cy="12" r="2" />
                                                        <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                                    </svg>
                                                </a>
                                            </span>
                                        </div>
                                        @error('password_confirm')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer flex justify-content-end align-items-center">
                            <div>
                                <a href="{{ route('dashboard.users.index') }}" class="btn btn-light">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection