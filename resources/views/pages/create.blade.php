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
                    Create New Page
                </h2>
            </div>
        </div>

        <form action="{{ route('dashboard.pages.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Form Create Page</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="title">Title of page <span class="text-danger">*</span></label>
                                        <input type="text" id="title" class="form-control" name="title" value="{{ old('title') }}">
                                        @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="menu">Menu <span class="text-danger">*</span></label>
                                        <select class="form-select" name="menu_id" id="menu">
                                            @foreach($menus as $menu)
                                            @if( old('menu_id') == $menu->id)
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
                                        <input type="file" class="form-control" name="image" />
                                        @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
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
                                            @if( old('body') )
                                            {{ old('body') }}
                                            @else
                                            <h2>Bilingual Personality Disorder</h2>
                                            <figure class=" image image-style-side"><img src="https://c.cksource.com/a/1/img/docs/sample-image-bilingual-personality-disorder.jpg">
                                                <figcaption>One language, one person.</figcaption>
                                            </figure>
                                            <p>
                                                This may be the first time you hear about this made-up disorder but
                                                it actually isn’t so far from the truth. Even the studies that were conducted almost half a century show that
                                                <strong>the language you speak has more effects on you than you realise</strong>.
                                            </p>
                                            @endif
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
                                <button type="submit" class="btn btn-primary">Create Page</button>
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