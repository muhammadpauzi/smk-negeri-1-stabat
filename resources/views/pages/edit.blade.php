@extends('layouts.app')

@include('partials.ckeditor-style')

@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center mb-3">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Page
                </div>
                <h2 class="page-title">
                    Edit Page
                </h2>
            </div>
        </div>

        <form action="{{ route('dashboard.pages.update', ['page' => $page->slug ]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Form Edit Page</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="title">Title of page <span class="text-danger">*</span></label>
                                        <input type="text" id="title" class="form-control" name="title" value="{{ old('title', $page->title) }}">
                                        <input type="hidden" id="old-title" class="form-control" name="old-title" value="{{ old('title', $page->title) }}">
                                        @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Slug</label>
                                        <div class="form-control-plaintext">{{ $page->slug }}</div>
                                        <input type="hidden" name="slug" value="{{ $page->slug }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="menu">Menu <span class="text-danger">*</span></label>
                                        <select class="form-select" name="menu_id" id="menu">
                                            @foreach($menus as $menu)
                                            @if( old('menu_id', $page->menu_id) == $menu->id)
                                            <option selected value="{{ $menu->id }}">{{ $menu->name }}</option>
                                            @else
                                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('menu_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        @if( count($menus) <= 0 ) <small class="text-muted py-2 d-block">
                                            Menu does not exists. Please <a href="{{ route('dashboard.menus.create') }}" class="text-primary">create menu first.</a>
                                            </small>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Upload Page Image</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- <div class="mb-3">
                                    <img src="" alt="" class="image-placeholder">
                                </div> -->
                                    <div class="mb-3">
                                        <div class="form-label">Page Image</div>

                                        <input type="hidden" name="old-page-image" value="{{ $page->image }}">

                                        @if($page->image)
                                        <img class="w-100 block rounded overflow-hidden mb-2" id="img-preview" src="{{ asset('storage/' . $page->image) }}" alt="">
                                        @endif

                                        <input type="file" class="form-control mb-2" name="image" />
                                        @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <small class="text-muted d-block">Choose file if you want to replace the previous image.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Content of page <span class="text-danger">*</span></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Content</label>
                                        <textarea id="editor" name="body">
                                        {{ old('body', $page->body) }}
                                        </textarea>
                                        @error('body')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer flex justify-content-end align-items-center">
                            <div>
                                <a href="{{ route('dashboard.pages.index') }}" class="btn btn-light">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Page</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@include('partials.ckeditor-script')
@endsection