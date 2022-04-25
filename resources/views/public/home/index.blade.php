@extends('layouts.public')

@section('content')
<div class="w-100 p-0 m-0 mt-0 mt-md-2">
    <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($slides as $slide)
            <!-- gambar slide diperbolehkan tinggi, namun disarankan agar admin memasukan gambar dengan dimensi yang sesuai -->
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img class="d-block w-100 image-slide" alt="" src="{{ asset('storage/' . $slide->image) }}">
                <div class="carousel-caption py-0 pt-2">
                    <h5 style="text-shadow: rgba(0, 0, 0, 0.8) 0px 0px 10px;" class="carousel-title">{{ $slide->title }}</h5>
                    @if( $slide->subtitle )
                    <p class="d-none d-md-block">{{ $slide->subtitle }}</p>
                    @endif
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

<div class="container-xl">
    <div class="row py-4">

        <div class="col-lg-8">
            <div class="row">

                <div class="d-flex align-items-center justify-content-between mb-0 mb-md-3">
                    <h2 class="fs-1">
                        @if($category)
                        All Articles in <span class="text-indigo-600">{{ $category->name }}</span>
                        @elseif($author)
                        All Articles by <span class="text-indigo-600">{{ $author->name }}</span>
                        @else
                        Berita Terbaru
                        @endif
                    </h2>

                    <a class="d-block text-primary" href="{{ route('home.index') }}">Clear filters</a>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <form method="GET" action="{{ route('home.index') }}" class="input-icon">
                        <div class="text-muted">
                            <input type="text" value="{{ request('search') }}" class="form-control w-100" placeholder="Search…" name="search">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="10" cy="10" r="7" />
                                    <line x1="21" y1="21" x2="15" y2="15" />
                                </svg>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                @if( count($articles) > 0 )
                @foreach($articles as $article)
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-img-top img-responsive img-responsive-21x9" style="background-image: url({{ asset('storage/' . $article->image) }})"></div>
                        <div class="card-body pb-3">
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('home.index', ['category' => $article->category->slug]) }}" class="d-inline-block text-uppercase text-primary fw-normal fs-4">{{ $article->category->name }}</a>
                                <span>•</span>
                                <small class="d-inline-block text-uppercase text-muted fw-normal fs-4">{{ $article->created_at->diffForHumans() }}</small>
                                <span>•</span>
                                <small class="d-inline-block text-uppercase text-muted fw-normal fs-4">{{ $article->views }} {{ Str::plural('view', $article->views) }}</small>
                            </div>
                            <h3 class="card-title fs-2 m-0">
                                <a href="{{ route('articles.show', ['article' => $article->slug]) }}" class="d-block pt-3 pb-2">{{ $article->title }}</a>
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
                                    <a href="{{ route('home.index', ['author' => $article->author->username]) }}" class="d-block text-muted text-uppercase d-block fw-bold">{{ $article->author->name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p class="text-danger py-3 m-0 text-center">Article not found. <a href="{{ route('home.index', ['search' => '']) }}">See all articles.</a></p>
                @endif
            </div>

            <div class="row py-2">
                <div class="d-flex align-items-center justify-content-between">
                    {{ $articles->onEachSide(5)->links() }}
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