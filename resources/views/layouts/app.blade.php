@extends('layouts.base')

@section('base')
<div class="page">
    @include('partials.navbar')

    <div class="page-wrapper">

        @yield('content')

        @include('partials.footer')
    </div>
</div>
@endsection