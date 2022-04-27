@extends('layouts.public')

@section('content')
<div class="container-xlpx-0 px-md-3">
    <div class="p-2">
        <div class="row py-4">
            <div class="col-lg-8">
                <div class="card mb-3">
                    @if( $page->image )
                    <div class="card-img-top img-responsive img-responsive-21x9" style="background-image: url({{ asset('storage/' . $page->image) }})"></div>
                    @endif

                    <div class="card-body py-3 px-2 px-md-3">
                        <h1 class="card-title mb-3 fw-bold" style="font-size: 1.5rem !important;">{{ $page->title }}</h1>

                        <div class="dropdown-divider"></div>

                        <div style="font-size: 1rem;" class="markdown">
                            {!! $page->body !!}
                        </div>

                        <div>
                            @include('partials.page-detail-info')
                        </div>
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
</div>
@endsection