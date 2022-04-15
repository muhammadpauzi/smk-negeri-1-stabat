@extends('layouts.app')

@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center mb-3">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Overview
                </div>
                <h2 class="page-title">
                    Article
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('articles.create') }}" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Create New Article
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="card p-2">
                <img class="rounded" src="{{ asset('storage/' . $article->image) }}"></img>
                <div class="px-3 py-4">
                    <h1 class="display-6 fw-normal">{{ $article->title }}</h1>
                    <div class="dropdown-divider"></div>

                    <div class="mt-5">
                        {!! $article->body !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <small class="text-uppercase text-muted fw-bold d-block mb-2">
                                Created at
                            </small>
                            <p class="d-block">{{ $article->created_at->format('d M Y H:i') }}</p>
                        </div>

                        <div class="dropdown-divider mb-3"></div>

                        <div class="mb-3">
                            <small class="text-uppercase text-muted fw-bold d-block mb-2">
                                Updated at
                            </small>
                            <p class="d-block">{{ $article->updated_at == $article->created_at ? 'Not updated yet' : $article->updated_at->format('d M Y H:i') }}</p>
                        </div>

                        <div class="dropdown-divider mb-3"></div>

                        <div class="mb-3">
                            <small class="text-uppercase text-muted fw-bold d-block mb-2">
                                Written by
                            </small>
                            <p class="d-block">{{ $article->author->name }}</p>
                        </div>

                        <div class="dropdown-divider mb-3"></div>

                        <div class="mb-3">
                            <small class="text-uppercase text-muted fw-bold d-block mb-2">
                                Category
                            </small>
                            <p class="d-block">{{ $article->category->name }}</p>
                        </div>

                        <div class="dropdown-divider mb-3"></div>

                        <div class="mb-3">
                            <small class="text-uppercase text-muted fw-bold d-block mb-2">
                                Publish Status
                            </small>
                            @if( $article->is_published )
                            <span class="badge bg-success me-1"></span> Published
                            @else
                            <span class="badge bg-danger me-1"></span>
                            Not published yet
                            @endif
                        </div>

                        <div class="dropdown-divider mb-3"></div>

                        <div class="mb-3">
                            <small class="text-uppercase text-muted fw-bold d-block mb-2">
                                View (s)
                            </small>
                            <p class="d-block">{{ $article->views }} {{ Str::plural( 'View',$article->views ) }}</p>

                        </div>

                        <div class="dropdown-divider mb-3"></div>

                    </div>
                </div>

                <div class="row">
                    <div class="w-100">
                        @can('update', $article)
                        <a class="w-100 btn btn-primary mb-2" href="{{ route('articles.edit', ['article' => $article->slug]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                <line x1="16" y1="5" x2="19" y2="8" />
                            </svg>
                            Edit
                        </a>
                        @endcan

                        @can('delete', $article)
                        <form action="{{ route('articles.destroy', ['article' => $article->slug]) }}" method="post" class="w-100 block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure to delete this article?')" class="btn btn-danger w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7h16" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    <path d="M10 12l4 4m0 -4l-4 4" />
                                </svg>
                                Delete this article
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection