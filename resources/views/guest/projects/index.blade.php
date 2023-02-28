@extends('layouts.app')
@section('title', 'Projects Overview')
@section('content')
<div class="container">
    <div class="row justify-content-center g-4">
        @foreach ($projects as $project)
        <div class="col-5">
            <div class="card h-100">
                <img src="{{$project->preview}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$project->name}} || {{$project->language_used}}</h5>
                    <p class="card-text">GitHub: <a class="text-danger "href="{{$project->github_url}}">{{$project->github_url}}</a></p>
                    <p class="card-text">Complessità: {{$project->complexity}}/5</p>
                    <p class="card-text"><small class="text-muted">Posted on {{$project->publication_date}}</small></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
