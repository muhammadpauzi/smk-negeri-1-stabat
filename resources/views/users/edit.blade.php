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
                    Edit User
                </h2>
            </div>
        </div>

        <form action="{{ route('users.update', ['user' => $user->id] ) }}" method="post">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Form Edit User</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name of user <span class="text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="username">Username <span class="text-danger">*</span></label>
                                        <input type="text" id="username" class="form-control" name="username" value="{{ old('username', $user->username) }}">
                                        <ul class="text-muted mt-2 block">
                                            <li>Can only contain letters, numbers, dashs and underscores</li>
                                        </ul>
                                        @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email Address <span class="text-danger">*</span></label>
                                        <input type="text" id="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
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
                                            @if( old('role', $user->role) == $role )
                                            <option selected value="{{ $role }}">{{ Str::ucfirst($role) }}</option>
                                            @else
                                            <option value="{{ $role }}">{{ Str::ucfirst($role) }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('role')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer flex justify-content-end align-items-center">
                            <div>
                                <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection