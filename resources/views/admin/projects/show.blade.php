@extends('layouts.app')
@section('title', $project->name)
@section('alert')
<link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('info-message'))
        <div class="col-12">
            <div class="alert alert-{{session('alert')}}">
                {{session('info-message')}}
            </div>
        </div>
        @endif
        <div class="col-md-6 col-sm-12">
            <div class="card text-center">
                <div class="card-header d-flex justify-content-between">
                    <p class="d-inline m-0">
                        <span class="badge rounded-pill" style="background-color: {{$project->type->color}}">{{$project->type->name}}</span>
                    </p>
                    <p class="d-inline-block m-0">
                        @for ($i = 0; $i < 5; $i++)
                        <span class="fa-star {{($i < $project->difficulty->id) ? 'fas' : 'far'}}"></span>
                        @endfor</p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$project->name}}</h5>
                    <div class="card-img">
                        {{-- <div class="card-image mb-4">
                            @if ( str_starts_with($post->image, 'http'))
                                <img src="{{ $post->image }}"
                            @else
                                <img src="{{ asset('storage/' . $post->image ) }}"
                            @endif
                                alt="{{ $post->title }} image" class="img-fluid">
                        </div> --}}
                        @if (str_starts_with($project->preview, 'http'))
                        <img src=" {{$project->preview}}"
                        @else
                        <img src="{{asset('storage/'. $project->preview)}}"
                        @endif
                        alt="preview of {{$project->name}}" class="img-fluid">
                    </div>
                    <p class="card-body">GitHub Link : <a href="{{$project->github_url}}">{{$project->github_url}}</a></p>
                        <div class="center-buttons">
                            <a href="{{route('admin.projects.index')}}" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
                            <a href="{{route('admin.projects.edit', $project->slug)}}" class="btn btn-outline-warning"><i class="fa-solid fa-edit"></i> Edit</a>
                            <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST" class="d-inline delete" data-element-name="{{$project->name}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                            </form>
                    </div>
                </div>
                    <div class="card-footer text-muted">
                    {{$project->publication_date}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    @vite('resources/js/deleteConfirm.js')
@endsection