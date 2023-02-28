@extends('layouts.app')

@section('title', "Edit '$type->name'")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <h3>Edit | {{$type->name}}</h3>
            @include('admin.types.partials.form', ['route' => 'admin.types.update','method' => 'PUT', 'type' => $type])
        </div>
    </div>
</div>
@endsection