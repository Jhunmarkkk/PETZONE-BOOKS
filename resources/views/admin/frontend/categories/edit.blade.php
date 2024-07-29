@extends('admin.layouts.app')

@section('title' , 'Admin-Edit category')

@section('content')

@if($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center;">
      @foreach($errors->all() as $error)
        {{$error}} <br>
      @endforeach 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

@endif

<div class="col-12 mt-5">
    <div class="card">
      <form id="edit-category-form" action="{{ route('admin.categories.update' , $category->id) }}" method="POST">
      @csrf
      @method('put')
        <div class="card-body">
            <div class="row">
                <div class="col">
                  <input type="text" name="slug" class="form-control" value="{{ $category->slug }}" placeholder="Slug" aria-label="slug">
                </div>
                <div class="col">
                  <input type="text" name="title" class="form-control" value="{{ $category->title }}" placeholder="Title" aria-label="title">
                </div>
            </div>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-primary" type="submit">Edit Category</button>
        </div>
      </form>
    </div>
</div>
@endsection