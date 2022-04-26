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
                    Page
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('dashboard.pages.create') }}" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Create New Page
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
                        <h3 class="card-title">List Pages</h3>
                    </div>
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('dashboard.pages.index') }}" class="input-icon">
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

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>Image & Title</th>
                                <th>Menu</th>
                                <th>Created at</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( count($pages) > 0 )
                            @foreach($pages as $page)
                            <tr>
                                <td><span class="text-muted">{{ ($pages->currentpage()-1) * $pages->perpage() + $loop->index + 1 }}</span></td>
                                <td class="flex">
                                    <div class="d-flex py-1 align-items-center">
                                        @if($page->image)
                                        <img class="avatar me-2" src="{{ asset('storage/' . $page->image) }}"></img>
                                        @endif
                                        <div class="flex-fill">
                                            <a href="{{ route('dashboard.pages.show', ['page' => $page->slug ] ) }}" class="text-reset" tabindex="-1">{{ Str::words($page->title, 5, '...') }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $page->menu->name }}
                                </td>
                                <td>
                                    {{ $page->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="text-start">
                                    <span class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                        <div class="dropdown-menu dropdown-menu-end">

                                            <form action="{{ route('dashboard.pages.destroy', ['page' => $page->slug]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure to delete this page?')" class="dropdown-item btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                            <a class="dropdown-item" href="{{ route('dashboard.pages.edit', ['page' => $page->slug]) }}">
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
                                    <p class="text-danger py-3 m-0 text-center">Page doesn't exists, <a href="{{ route('dashboard.pages.create') }}">Create page now!</a></p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    {{ $pages->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection