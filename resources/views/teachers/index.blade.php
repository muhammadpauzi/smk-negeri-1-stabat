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
                    Teacher
                </h2>
            </div>
            <!-- Page title actions -->
            @if( auth()->user()->isSuperadminOrAdmin() )
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('dashboard.teachers.create') }}" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Create New Teacher
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
                        <h3 class="card-title">List Teachers</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">
                            <form method="GET" action="{{ route('dashboard.teachers.index') }}" class="input-icon">
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
                                <th>NUPTK</th>
                                <th>NIP</th>
                                <th>Address</th>
                                <th>Jenis PTK</th>
                                <th>Tugas Tambahan</th>
                                <th>Golongan</th>
                                @if( auth()->user()->isSuperadminOrAdmin() )
                                <th></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if( count($teachers) > 0 )
                            @foreach($teachers as $teacher)
                            <tr>
                                <td><span class="text-muted">{{ ($teachers->currentpage()-1) * $teachers->perpage() + $loop->index + 1 }}</span></td>
                                <td>
                                    {{ $teacher->name }}
                                </td>
                                <td>
                                    {{ $teacher->nuptk  }}
                                </td>
                                <td>
                                    {{ $teacher->nip }}
                                </td>
                                <td>
                                    {{ $teacher->address }}
                                </td>
                                <td>
                                    {{ $teacher->jenis_ptk }}
                                </td>
                                <td>
                                    {{ $teacher->tugas_tambahan }}
                                </td>
                                <td>
                                    {{ $teacher->golongan }}
                                </td>
                                @if( auth()->user()->isSuperadminOrAdmin() )
                                <td class="text-start">
                                    <span class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <form action="{{ route('dashboard.teachers.destroy', ['teacher' => $teacher->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure to delete this teacher?')" class="dropdown-item btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                            <a class="dropdown-item" href="{{ route('dashboard.teachers.edit', ['teacher' => $teacher->id]) }}">
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
                                <td colspan="8">
                                    <p class="text-danger py-3 m-0 text-center">Teachers doesn't exists, <a href="{{ route('dashboard.teachers.create') }}">Create teacher now!</a></p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    {{ $teachers->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection