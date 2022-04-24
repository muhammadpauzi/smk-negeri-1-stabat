@extends('layouts.app')

@section('content')
<div class="container-xl">
  <!-- Page title -->
  <div class="page-header d-print-none">
    <div class="row align-items-center mb-3">
      <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
          Slide
        </div>
        <h2 class="page-title">
          Create New Slide
        </h2>
      </div>
    </div>

    <form action="{{ route('dashboard.slides.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="row">
        <div class="col-md-6">
          <div class="card mb-2">
            <div class="card-header">
              <h4 class="card-title">Form Create Slide</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label" for="title">Title of slide <span class="text-danger">*</span></label>
                    <input type="text" id="title" class="form-control" name="title" autocomplete="slide-title" value="{{ old('title') }}">
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="subtitle">Subtitle</label>
                    <textarea id="subtitle" class="form-control" name="subtitle" rows="6" placeholder="Subtitle of slide..">{{ old('subtitle') }}</textarea>
                    @error('subtitle')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="url">URL/Link</label>
                    <input type="text" id="url" class="form-control" name="url" placeholder="https://example.com/" autocomplete="slide-url" value="{{ old('url') }}">
                    @error('url')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card mb-2">
            <div class="card-header">
              <h4 class="card-title">Upload Slide Image</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <!-- <div class="mb-3">
                                    <img src="" alt="" class="image-placeholder">
                                </div> -->
                  <div class="mb-3">
                    <div class="form-label">Slide Image <span class="text-danger">*</span></div>
                    <input type="file" class="form-control" name="image" />
                    @error('image')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer flex justify-content-end align-items-center">
              <div>
                <a href="{{ route('dashboard.slides.index') }}" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Slide</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection