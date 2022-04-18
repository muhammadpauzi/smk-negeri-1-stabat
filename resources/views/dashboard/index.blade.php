@extends('layouts.app')

@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Overview
                </div>
                <h2 class="page-title">
                    Dashboard
                </h2>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="row row-deck row-cards mb-3">

            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Articles</div>
                            <div class="ms-auto lh-1">
                                <a href="{{ route('articles.create') }}">Create Article</a>
                            </div>
                        </div>
                        <div class="h1 mb-3">{{ $articles->count() }} {{ Str::plural('Article', $articles->count()) }}</div>
                        <div class="d-flex mb-2">
                            <div>Pubslished Articles</div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-blue" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Published Articles ({{ $articlePercentages['published'] . '%' }})" style="width: {{ $articlePercentages['published'] . '%' }}" role="progressbar" aria-valuenow="{{ $articlePercentages['published'] }}" aria-valuemin="0" aria-valuemax="100">
                                <span class="visually-hidden">{{ $articlePercentages['published'] }}% Complete</span>
                            </div>
                            <div class="progress-bar bg-transparent" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Unpublished Articles ({{ $articlePercentages['unpublished'] . '%' }})" style="width: {{ $articlePercentages['unpublished'] . '%' }}" role="progressbar" aria-valuenow="{{ $articlePercentages['unpublished'] }}" aria-valuemin="0" aria-valuemax="100">
                                <span class="visually-hidden">{{ $articlePercentages['unpublished'] }}% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Categories</div>
                            <div class="ms-auto lh-1">
                                @if( auth()->user()->isSuperadminOrAdmin() )
                                <a href="{{ route('articles.create') }}">Create Category</a>
                                @else
                                <a href="{{ route('articles.index') }}">Categories</a>
                                @endif
                            </div>
                        </div>
                        <div class="h1 mb-3">{{ $categories->count() }} {{ Str::plural('Category', $categories->count()) }}</div>
                    </div>

                </div>
            </div>

            @if( auth()->user()->isSuperadmin() )
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Users</div>
                            <div class="ms-auto lh-1">
                                <a href="{{ route('users.create') }}">Create User</a>
                            </div>
                        </div>
                        <div class="h1 mb-3">{{ $users->count() }} {{ Str::plural('User', $users->count()) }}</div>
                        <div class="d-flex mb-2">
                            <div>Users by Role</div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-blue" data-bs-toggle="tooltip" data-bs-placement="bottom" title="User with role Superadmin ({{ $userPercentages['superadmin'] . '%' }})" style="width: {{ $userPercentages['superadmin'] . '%' }}" role="progressbar" aria-valuenow="{{ $userPercentages['superadmin'] }}" aria-valuemin="0" aria-valuemax="100">
                                <span class="visually-hidden">{{ $userPercentages['superadmin'] }}% Complete</span>
                            </div>
                            <div class="progress-bar bg-green" data-bs-toggle="tooltip" data-bs-placement="bottom" title="User with role Admin ({{ $userPercentages['admin'] . '%' }})" style="width: {{ $userPercentages['admin'] . '%' }}" role="progressbar" aria-valuenow="{{ $userPercentages['admin'] }}" aria-valuemin="0" aria-valuemax="100">
                                <span class="visually-hidden">{{ $userPercentages['admin'] }}% Complete</span>
                            </div>
                            <div class="progress-bar bg-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="User with role Editor ({{ $userPercentages['editor'] . '%' }})" style="width: {{ $userPercentages['editor'] . '%' }}" role="progressbar" aria-valuenow="{{ $userPercentages['editor'] }}" aria-valuemin="0" aria-valuemax="100">
                                <span class="visually-hidden">{{ $userPercentages['editor'] }}% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Slides</div>
                            <div class="ms-auto lh-1">
                            </div>

                            <div class="ms-auto lh-1">
                                @if( auth()->user()->isSuperadminOrAdmin() )
                                <a href="{{ route('slides.create') }}">Create Slide</a>
                                @else
                                <a href="{{ route('slides.index') }}">Slides</a>
                                @endif
                            </div>
                        </div>
                        <div class="h1 mb-3">{{ $slides->count() }} {{ Str::plural('Slide', $slides->count()) }}</div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Majors (Jurusan)</div>
                            <div class="ms-auto lh-1">
                            </div>

                            <div class="ms-auto lh-1">
                                @if( auth()->user()->isSuperadminOrAdmin() )
                                <a href="{{ route('majors.create') }}">Create Major</a>
                                @else
                                <a href="{{ route('majors.index') }}">Majors</a>
                                @endif
                            </div>
                        </div>
                        <div class="h1 mb-3">{{ $majors->count() }} {{ Str::plural('Major', $majors->count()) }}</div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Students</div>
                            <div class="ms-auto lh-1">
                            </div>

                            <div class="ms-auto lh-1">
                                @if( auth()->user()->isSuperadminOrAdmin() )
                                <a href="{{ route('students.create') }}">Create Student</a>
                                @else
                                <a href="{{ route('students.index') }}">Students</a>
                                @endif
                            </div>
                        </div>
                        <div class="h1 mb-3">{{ $students->count() }} {{ Str::plural('Student', $students->count()) }}</div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Teachers</div>
                            <div class="ms-auto lh-1">
                            </div>

                            <div class="ms-auto lh-1">
                                @if( auth()->user()->isSuperadminOrAdmin() )
                                <a href="{{ route('teachers.create') }}">Create Teacher</a>
                                @else
                                <a href="{{ route('teachers.index') }}">Teachers</a>
                                @endif
                            </div>
                        </div>
                        <div class="h1 mb-3">{{ $teachers->count() }} {{ Str::plural('Teacher', $teachers->count()) }}</div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Article Views</div>
                            <div class="ms-auto lh-1">
                            </div>
                        </div>
                        <div class="h1 mb-3">{{ $totalArticleViews }} {{ Str::plural('View', $totalArticleViews) }}</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection