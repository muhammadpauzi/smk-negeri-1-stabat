@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('ckeditor.css') }}">
<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }
</style>
@endsection

@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center mb-3">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Article
                </div>
                <h2 class="page-title">
                    Edit Article
                </h2>
            </div>
        </div>

        <form action="{{ route('articles.update', ['article' => $article->slug ]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Form Edit Article</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="title">Title of article <span class="text-danger">*</span></label>
                                        <input type="text" id="title" class="form-control" name="title" value="{{ old('title', $article->title) }}">
                                        @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Slug</label>
                                        <div class="form-control-plaintext">{{ $article->slug }}</div>
                                        <input type="hidden" name="slug" value="{{ $article->slug }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                                        <textarea id="description" class="form-control" name="description" rows="6" placeholder="Description of article..">{{ old('description', $article->description) }}</textarea>
                                        @error('description')
                                        <small class=" text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Publish</label>
                                        <label class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" @if( old('is-published', $article->is_published) ) checked @endif name="is-published">
                                            <span class="form-check-label">
                                                Publish Article
                                            </span>
                                            <span class="form-check-description">
                                                Publish this article after it is made.
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Category of Article</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="category">Category <span class="text-danger">*</span></label>
                                        <select class="form-select" name="category_id" id="category">
                                            @foreach($categories as $category)
                                            @if( old('category_id', $article->category_id) == $category->id)
                                            <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                            @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="card-title">Edit Thumbnail Image</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- <div class="mb-3">
                                    <img src="" alt="" class="image-placeholder">
                                </div> -->
                                    <div class="mb-3">
                                        <div class="form-label">Thumbnail Image</div>

                                        <input type="hidden" name="old-article-image" value="{{ $article->image }}">
                                        @if($article->image)
                                        <img class="w-100 block rounded overflow-hidden mb-2" id="img-preview" src="{{ asset('storage/' . $article->image) }}" alt="">
                                        @else
                                        <img class="w-100 block rounded overflow-hidden mb-2" id="img-preview" alt="">
                                        @endif

                                        <input type="file" class="form-control mb-2" name="image" />
                                        @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <small class="text-muted block">Choose file if you want to replace the previous image.</small>
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
                            <h4 class="card-title">Content of article <span class="text-danger">*</span></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Content</label>
                                        <textarea id="editor" name="body">
                                        {{ old('body', $article->body) }}
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
                                <a href="{{ route('articles') }}" class="btn btn-light">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Article</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection