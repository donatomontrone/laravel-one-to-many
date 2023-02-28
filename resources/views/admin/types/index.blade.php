@extends('layouts.app')
@section('title', 'Portfolio | Index')

@section('alert')
<link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
      @if (session('info-message'))
      <div class="col-12">
          <div class="alert alert-{{session('alert')}}">
              {{session('info-message')}}
          </div>
      </div>
      @endif
      <div class="card p-0">
        <div class="card-header">
          <div class="row">
            <div class="col-6">
              <h2 class="m-0">Types</h2>
            </div>
            <div class="col-6 text-end">
              <a href="{{route('admin.types.create')}}" class="btn btn-outline-dark"><i class="fa-solid fa-plus"></i> Add Type</a>
            </div>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table mb-0">
              <thead class="table-dark lh-lg">
                <tr>
                  <th scope="col">ID <a href="{{route('admin.types.index')}}" class="text-white"></a></th>
                  <th scope="col" >Name <a href="{{route('admin.types.index')}}" class="text-white d-inline-block"></a></th>
                  <th scope="col">Color <a href="{{route('admin.types.index')}}" class="text-white d-inline-block"></a></th>
                  <th scope="col" class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($types as $type)
                <tr>
                  <th scope="row">{{$type->id}}</th>
                  <td>{{$type->name}}</td>
                  <td>{{$type->color}} <div class="color-index d-inline-block" style="background-color:{{$type->color}}"></div></td>
                  <td class="text-center">
                    <a href="{{route('admin.types.show', $type->id)}}" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{route('admin.types.edit', $type->id)}}" class="btn btn-outline-success btn-sm"><i class="fa-solid fa-edit"></i></a>
                    <form action="{{route('admin.types.destroy', $type->id)}}" method="POST" class="d-inline delete" data-element-name="{{$type->name}}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @empty
                    <tr>
                      <td colspan="6">No item </td>
                    </tr>
                @endforelse
              </tbody>
            </table>
            
          </div>
        </div>
      </div>
</div>
@endsection

@section('scripts')
    @vite('resources/js/deleteConfirm.js')
@endsection