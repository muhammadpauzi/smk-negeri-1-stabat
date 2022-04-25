@extends('layouts.public')

@section('content')
<div class="container px-0 px-md-3">
    <div class="p-2">
        <div class="row py-4">
            <div class="col-lg-8">
                <div class="card mb-3">
                    <div class="card-img-top img-responsive img-responsive-21x9" style="background-image: url({{ asset('storage/' . $major->kepala_sekolah_image) }})"></div>

                    <div class="card-body py-3 px-2 px-md-3">
                        <h1 class="card-title mb-3 fw-bold" style="font-size: 1.5rem !important;">{{ $major->name }}</h1>

                        <div class="dropdown-divider"></div>

                        <div style="font-size: 1rem;">
                            {!! $major->body !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- col-lg-4 karena ada gap di parent -->
            <div class="col-lg-4">
                <div class="d-block mb-2">
                    <div class="card p-3">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <small class="text-uppercase text-muted fw-bold d-block mb-2">
                                        Head of Major
                                    </small>
                                    @if( $major->head->image )
                                    <img src="{{ asset('storage/' . $major->head->image) }}" alt="" class="w-100 rounded mb-3 block">
                                    @else
                                    <p>No image</p>
                                    @endif
                                    <a href="{{ route('dashboard.teachers.index', ['techer' => $major->head->name]) }}" class="d-block text-reset">{{ $major->head->name }}</a>
                                </div>

                                <div class="dropdown-divider mb-3"></div>

                                <div class="mb-3">
                                    <small class="text-uppercase text-muted fw-bold d-block mb-2">
                                        Created at
                                    </small>
                                    <p class="d-block">{{ $major->created_at?->format('d M Y H:i') }}</p>
                                </div>

                                <div class="dropdown-divider mb-3"></div>

                                <div class="mb-3">
                                    <small class="text-uppercase text-muted fw-bold d-block mb-2">
                                        Updated at
                                    </small>
                                    <p class="d-block">{{ $major->updated_at == $major->created_at ? 'Not updated yet' : $major->updated_at->format('d M Y H:i') }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-block">
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
    </div>
</div>
@endsection