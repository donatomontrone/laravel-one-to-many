@extends('layouts.app')
@section('title', $type->name)
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
            <div class="card p-3">
                <div class="color text-center">
                    <div class="rounded-circle" style="background-color: {{$type->color}}">
                    </div>
                    <h3>{{$type->name}}</h3>
                    <p>{{$type->color}}</p>
                    <div class="center-buttons">
                        <a href="{{route('admin.types.index')}}" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
                        <a href="{{route('admin.types.edit', $type->id)}}" class="btn btn-outline-warning"><i class="fa-solid fa-edit"></i> Edit</a>
                        <form action="{{route('admin.types.destroy', $type->id)}}" method="POST" class="d-inline delete" data-element-name="{{$type->name}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    @vite('resources/js/deleteConfirm.js')
@endsection