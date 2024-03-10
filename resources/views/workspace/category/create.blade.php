@extends('template')

@php
  $title= "Category";
@endphp

@php
  $pretitle= "category/create";
@endphp

@section('body')
<form class="card" action="{{ route('workspace.category.store') }}" method="POST">
    @csrf
    <div class="card-header">
      <h3 class="card-title">Add Category</h3>
    </div>
    <div class="card-body">
      <div class="mb-3">
        <label class="form-label required">Category Name</label>
        <div>
          <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name">
        </div>
      </div>
    </div>
    <div class="card-footer text-end">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
@endsection
