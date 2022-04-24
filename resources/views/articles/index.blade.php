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
                    @if(auth()->user()->isSuperadminOrAdmin())
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('articles.index', ['all' => true]) }}" class="btn btn-white">
                            All Articles
                        </a>
                    </span>
                    @endif
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
        <div class="col">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <h3 class="card-title">List Articles</h3>
                    </div>
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('dashboard.articles.index') }}" class="input-icon">
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="form-select" name="limit" id="limit">
                                        <option selected value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="All">All</option>
                                    </select>
                                </div>
                                <div class="col-md-9">
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
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>Thumbnail & Title</th>
                                <th>Created at</th>
                                <th>View (s)</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( count($articles) > 0 )
                            @foreach($articles as $article)
                            <tr>
                                <td><span class="text-muted">{{ ($articles->currentpage()-1) * $articles->perpage() + $loop->index + 1 }}</span></td>
                                <td class="flex">
                                    <div class="d-flex py-1 align-items-center">
                                        <img class="avatar me-2" src="{{ asset('storage/' . $article->image) }}"></img>
                                        <div class="flex-fill">
                                            <a href="{{ route('dashboard.articles.show', ['article' => $article->slug ] ) }}" class="text-reset" tabindex="-1">{{ Str::words($article->title, 5, '...') }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $article->created_at->format('d M Y H:i') }}
                                </td>
                                <td>
                                    {{ $article->views }} x
                                </td>
                                <td>
                                    @if( $article->is_published )
                                    <span class="badge bg-success me-1"></span> Published
                                    @else
                                    <span class="badge bg-danger me-1"></span>
                                    Not published yet
                                    @endif
                                </td>
                                <td class="text-start">
                                    <span class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                        <div class="dropdown-menu dropdown-menu-end">

                                            <form action="{{ route('dashboard.articles.destroy', ['article' => $article->slug]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure to delete this article?')" class="dropdown-item btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                            <a class="dropdown-item" href="{{ route('dashboard.articles.edit', ['article' => $article->slug]) }}">
                                                Edit
                                            </a>
                                        </div>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">
                                    <p class="text-danger py-3 m-0 text-center">Article doesn't exists, <a href="{{ route('dashboard.articles.create') }}">Create article now!</a></p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection