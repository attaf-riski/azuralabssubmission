@extends('template')

@php
  $title= "Category";
@endphp

@php
  $pretitle= "category/edit";
@endphp

@section('body')
<form class="card" action="{{ route('workspace.category.update', $category->id) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="card-header">
      <h3 class="card-title">Edit Category</h3>
    </div>
    <div class="card-body">
      <div class="mb-3">
        <label class="form-label required">Category Name</label>
        <div>
          <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" value="{{ $category->name }}">
        </div>
      </div>
    </div>
    <div class="card-footer text-end">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
@endsection
