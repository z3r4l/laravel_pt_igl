@extends('errors.layout')

@section('title', __('Not Found'))

@section('content')
<div class="error-page container">
    <div class="col-md-8 col-12 offset-md-2">
        <div class="text-center">
            <img class="img-error" src="{{ asset('back/assets/compiled/svg/error-404.svg') }}" alt="Not Found">
            <h1 class="error-title">NOT FOUND</h1>
            <p class='fs-5 text-gray-600'>The page you are looking not found.</p>
            @include('back.partial.buttonBack')
        </div>
    </div>
</div>
@endsection
