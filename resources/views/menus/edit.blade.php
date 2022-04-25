@extends('layouts.app')

@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center mb-3">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Menu
                </div>
                <h2 class="page-title">
                    Edit Menu
                </h2>
            </div>
        </div>

        <form action="{{ route('dashboard.menus.update', ['menu' => $menu->id ]) }}" method="post">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Form Update Menu</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name of menu <span class="text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" autocomplete="menu-name" value="{{ old('name', $menu->name) }}">
                                        <input type="hidden" id="old-name" class="form-control" name="old-name" value="{{ old('name', $menu->name) }}">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="icon">Icon</label>
                                        <textarea id="icon" class="form-control" name="icon" rows="6" placeholder="Icon of menu (SVG HTML Element)..">{{ old('icon', $menu->icon) }}</textarea>
                                        @error('icon')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <small class="text-muted py-2">SVG HTML Element</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer flex justify-content-end align-items-center">
                            <div>
                                <a href="{{ route('dashboard.menus.index') }}" class="btn btn-light">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Menu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection