@extends('errors.layout')
@section('title', __('Forbidden'))
@section('content')
<div class="error-page container">
    <div class="col-md-8 col-12 offset-md-2">
        <div class="text-center">
            <img class="img-error" src="{{ asset('back/assets/compiled/svg/error-403.svg') }}" alt="Not Found">
            <h1 class="error-title">Forbidden</h1>
            <p class="fs-5 text-gray-600">You are unauthorized to see this page.</p>
            @include('back.partial.buttonBack')
        </div>
    </div>
</div>
@endsection