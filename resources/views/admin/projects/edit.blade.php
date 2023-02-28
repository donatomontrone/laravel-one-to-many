@extends('layouts.app')

@section('title', "Edit '$project->name'")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <h3>Edit | {{$project->name}}</h3>
            @include('admin.projects.partials.form', ['route' => 'admin.projects.update','method' => 'PUT', 'project' => $project])
        </div>
    </div>
</div>
@endsection