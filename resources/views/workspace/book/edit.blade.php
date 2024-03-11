@extends('template')

@php
    $title = 'Book';
@endphp

@php
    $pretitle = 'book/edit';
@endphp

@section('body')
    <form class="card" action="{{ route('workspace.book.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-header">
            <h3 class="card-title">Edit Book</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label required">Title</label>
                <div>
                    <input type="text" class="form-control" name="title" placeholder="Enter Title"
                        value="{{ $book->title}}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Author</label>
                <div>
                    <input type="text" class="form-control" name="author" placeholder="Enter Author"
                        value="{{ $book->author }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Category</label>
                <div>
                    <select class="form-select" name="category_id">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($category->id == $book->category_id) selected @endif>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Publication Date</label>
                <div>
                    <input type="date" class="form-control" name="publication_date"
                        value="{{ $book->publication_date }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Publisher</label>
                <div>
                    <input type="text" class="form-control" name="publisher" placeholder="Enter Publisher"
                        value="{{ $book->publisher }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Number Of Pages</label>
                <div>
                    <input type="number" class="form-control" name="number_of_pages" placeholder="Enter Number Of Pages"
                        value="{{ $book->number_of_pages }}">
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
    </form>
@endsection
