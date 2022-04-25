@extends('layouts.public')

@section('content')
<div class="row mt-0 mt-md-2">
    <div class="col">
        <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($slides as $slide)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img class="d-block w-100 image-slide" alt="" src="{{ asset('storage/' . $slide->image) }}">
                    <div class="carousel-caption py-0 pt-2">
                        <h5 style="text-shadow: rgba(0, 0, 0, 0.8) 0px 0px 10px;">{{ $slide->title }}</h5>
                    </div>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carousel-controls" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-controls" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>
</div>

<div class="container-xl">
    <div class="row py-4">

        <div class="col-lg-8">
            <h2 class="fs-1 mb-3">Berita Terbaru</h2>

            <div class="row">
                @foreach($articles as $article)
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-img-top img-responsive img-responsive-21x9" style="background-image: url({{ asset('storage/' . $article->image) }})"></div>
                        <div class="card-body pb-3">
                            <div class="d-flex align-items-center gap-2">
                                <a href="#" class="d-inline-block text-uppercase text-primary fw-normal fs-4">{{ $article->category->name }}</a>
                                <span>•</span>
                                <small class="d-inline-block text-uppercase text-muted fw-normal fs-4">{{ $article->created_at->diffForHumans() }}</small>
                                <span>•</span>
                                <small class="d-inline-block text-uppercase text-muted fw-normal fs-4">{{ $article->views }} {{ Str::plural('view', $article->views) }}</small>
                            </div>
                            <h3 class="card-title fs-2 mb-1">
                                <a href="{{ route('articles.show', ['article' => $article->slug]) }}" class="d-block py-3">{{ $article->title }}</a>
                            </h3>
                            <p class="text-muted fs-3 mb-3 d-block">{{ $article->description }}</p>

                            <div class="d-flex align-items-center w-100">
                                <div class="rounded-circle me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                        <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                                    </svg>
                                </div>

                                <div class="w-100">
                                    <a href="" class="d-block text-muted text-uppercase d-block fw-bold">{{ $article->author->name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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