@extends('layouts.app')
@section('content')

<div class="jumbotron p-5 mb-4 rounded-3 h-100">
    <div class="container py-5">
        @guest
        <h1 class="fw-bold">
            Welcome in BoolPress
        </h1>

        <p class="col-md-8 fs-4">Log in to access exclusive content or click on the button below for an overview of the projects developed</p>
        <a href="{{route('guests.index')}}" class="btn btn-outline-dark">Overview</a>
        @else
        <h1 class="display-5 fw-bold">
            Portfolio
        </h1>

        <p class="col-md-8 fs-4">In this portfolio there will be a list of projects done during the course. It works in laravel 9.x to the latest release 10.x</p>
        @endguest
    </div>
</div>
@endsection