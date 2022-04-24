@extends('layouts.base')

@section('base')
<div class="page">
    @include('partials.public-navbar')

    <div class="page-wrapper">

        @yield('content')

        @include('partials.public-footer')
    </div>
</div>
@endsection