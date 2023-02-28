@extends('layouts.app')

@section('title', 'Create New Type')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <h3>Add a new Type</h3>
            @include('admin.types.partials.form', ['route' => 'admin.types.store','method' => 'POST', 'type' => $type])
        </div>
    </div>
</div>
@endsection