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
                    Majors (Jurusan)
                </h2>
            </div>
            <!-- Page title actions -->
            @if( auth()->user()->isSuperadmin() )
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('majors.create') }}" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Create New Major
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <h3 class="card-title">List Majors</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">
                            <form method="GET" action="{{ route('majors.index') }}" class="input-icon">
                                <input type="text" value="{{ request('search') }}" class="form-control w-100" placeholder="Search…" name="search">
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <circle cx="10" cy="10" r="7" />
                                        <line x1="21" y1="21" x2="15" y2="15" />
                                    </svg>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Head of Major</th>
                                @if( auth()->user()->isSuperadmin() )
                                <th></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if( count($majors) > 0 )
                            @foreach($majors as $major)
                            <tr>
                                <td><span class="text-muted">{{ $loop->iteration }}</span></td>
                                <td>
                                    <a href="{{ route('majors.show', ['major' => $major->slug]) }}" class="text-reset">{{ $major->name }}</a>
                                </td>
                                <td>
                                    {{ $major->description ? Str::words($major->description, 50, '...') : 'No description' }}
                                </td>
                                <td>
                                    @if( $major->head?->name )
                                    <a href="{{ route('teachers.index', ['search' => $major->head->name ]) }}"> {{ $major->head->name }}</a>
                                    @else
                                    Teacher was deleted.
                                    @endif
                                </td>
                                @if( auth()->user()->isSuperadmin() )
                                <td class="text-start">
                                    <span class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                        <div class="dropdown-menu dropdown-menu-end">

                                            <form action="{{ route('majors.destroy', ['major' => $major->slug]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure to delete this major?')" class="dropdown-item btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                            <a class="dropdown-item" href="{{ route('majors.edit', ['major' => $major->slug]) }}">
                                                Edit
                                            </a>
                                        </div>
                                    </span>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">
                                    <p class="text-danger py-3 m-0 text-center">Major doesn't exists, <a href="{{ route('majors.create') }}">Create major now!</a></p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    {{ $majors->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection