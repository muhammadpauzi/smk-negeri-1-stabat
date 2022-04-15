@extends('layouts.base')

@section('base')
<div class="border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
        <div class="page-wrapper">

            @yield('content')

            @include('partials.footer')
        </div>
    </div>
</div>
@endsection