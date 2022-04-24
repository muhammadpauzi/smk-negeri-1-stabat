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
                    Student
                </h2>
            </div>
            <!-- Page title actions -->
            @if( auth()->user()->isSuperadminOrAdmin() )
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('dashboard.students.create') }}" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Create New Student
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
                        <h3 class="card-title">List Students</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">
                            <form method="GET" action="{{ route('dashboard.students.index') }}" class="input-icon">
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
                                <th>NISN</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Place of Birth</th>
                                <th>Date of Birth</th>
                                <th>Religion</th>
                                <th>Address</th>
                                <th>Rombongan Belajar</th>
                                @if( auth()->user()->isSuperadminOrAdmin() )
                                <th></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if( count($students) > 0 )
                            @foreach($students as $student)
                            <tr>
                                <td><span class="text-muted">{{ ($students->currentpage()-1) * $students->perpage() + $loop->index + 1 }}</span></td>
                                <td>
                                    {{ $student->nisn }}
                                </td>
                                <td>
                                    {{ $student->name  }}
                                </td>
                                <td>
                                    {{ Str::ucfirst($student->gender)  }}
                                </td>
                                <td>
                                    {{ $student->place_of_birth }}
                                </td>
                                <td>
                                    {{ $student->date_of_birth }}
                                </td>
                                <td>
                                    {{ $student->religion }}
                                </td>
                                <td>
                                    {{ $student->address }}
                                </td>
                                <td>
                                    {{ $student->rombongan_belajar }}
                                </td>
                                @if( auth()->user()->isSuperadminOrAdmin() )
                                <td class="text-start">
                                    <span class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <form action="{{ route('dashboard.students.destroy', ['student' => $student->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure to delete this student?')" class="dropdown-item btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                            <a class="dropdown-item" href="{{ route('dashboard.students.edit', ['student' => $student->id]) }}">
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
                                    <p class="text-danger py-3 m-0 text-center">Students doesn't exists, <a href="{{ route('dashboard.students.create') }}">Create student now!</a></p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection