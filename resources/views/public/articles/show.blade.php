@extends('layouts.public')

@section('content')
<div class="container-xl">
    <div class="row py-4">

        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-img-top img-responsive img-responsive-21x9" style="background-image: url({{ asset('storage/' . $article->image) }})"></div>
                <div class="card-body pb-3">
                    <div class="d-flex align-items-center gap-2">
                        <a href="#" class="d-inline-block text-uppercase text-primary fw-bold fs-3">{{ $article->category->name }}</a>
                        <span>•</span>
                        <small class="d-inline-block text-uppercase text-muted fw-bold fs-3">{{ $article->created_at->diffForHumans() }}</small>
                        <span>•</span>
                        <small class="d-inline-block text-uppercase text-muted fw-bold fs-3">{{ $article->views }} {{ Str::plural('view', $article->views) }}</small>
                        <div>
                            <a href="" class="text-muted text-uppercase d-block fw-bold">{{ $article->author->name }}</a>
                        </div>
                    </div>
                    <h3 class="card-title fs-2 mb-1">
                        <a href="#" class="d-block py-3">{{ $article->title }}</a>
                    </h3>
                    <p class="text-muted fs-3 mb-3 d-block">{{ $article->description }}</p>

                    <div class="d-flex align-items-center">
                        <div class="rounded-circle me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                            </svg>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- col-lg-4 karena ada gap di parent -->
    <div class="col-lg-4">
        <h2 class="fs-1 mb-3">Kata Sambutan</h2>

        <div class="card card-sm w-full">
            <img src="{{ asset('storage/' . $schoolProfile->kepala_sekolah_image) }}" class="card-img-top">
            <div class="card-body text-center">
                <h3 class="fs-2">{{ $schoolProfile->kepala_sekolah }}</h3>
                <div class="text-muted mb-3">Kepala Sekolah SMK Negeri 1 Stabat</div>

                <div style="text-align: justify;" class="fs-3">{!! $schoolProfile->kata_sambutan !!}</div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection