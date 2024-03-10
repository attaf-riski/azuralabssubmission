@extends('template')

@php
  $title= "Category";
@endphp

@php
  $pretitle= "category/index";
@endphp


@section('body')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Book Category</h3>
        </div>
        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="text-muted">
                    Show
                    <div class="mx-2 d-inline-block">
                        <input type="number" id="data_count_shows" class="form-control form-control-sm" size="3" placeholder="{{ $categories->perPage() }}"
                            aria-label="Invoices count">
                    </div>
                    entries
                </div>
                <div class="ms-auto text-muted">
                    Search:
                    <div class="ms-2 d-inline-block">
                        <input type="text" id="search" class="form-control form-control-sm" placeholder="find category.."> 
                    </div>

                </div>
                <div class="ms-auto">
                    <a href="{{ route('workspace.category.create') }}">
                        <button class="btn btn-sm btn-primary">Add Category</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="table-responsive" style="overflow: visible">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th class="w-1">No
                        </th>
                        <th>Name</th>
                        <th></th>
                    </tr>
                </thead>
                {{-- make the number relate --}}
                @php
                    $i = 1 + ($categories->currentPage() - 1) * $categories->perPage();
                @endphp
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td><span class="text-muted">{{ $i++ }}</span></td>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td class="text-end">
                                <div class="btn-group mb-1 dropleft ">
                                    <div class="dropdown dropleft">
                                        <button class="btn btn-primary dropdown-toggle me-1" type="button"
                                            id="dropdownMenuButtonIcon" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item"
                                                href="{{ route('workspace.category.edit', $category->id) }}">
                                                Edit
                                            </a>
                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#modalDelete-{{ $category->id }}">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <div class="modal modal-blur fade" id="modalDelete-{{ $category->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="modal-status bg-danger"></div>
                                        <div class="modal-body text-center py-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 9v4"></path>
                                                <path
                                                    d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                                                </path>
                                                <path d="M12 16h.01"></path>
                                            </svg>
                                            <h3>Are you sure?</h3>
                                            <div class="text-secondary">Do you really want to remove book category
                                                {{ $category->title }}? What you've done cannot be undone.
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="w-100">
                                                <div class="row">
                                                    <form
                                                        action="{{ route('workspace.category.destroy', ['id' => $category->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="col">
                                                            <a href="#" class="btn w-100"
                                                                data-bs-dismiss="modal">Cancel</a>
                                                        </div>
                                                        <div class="col">
                                                            <button type="submit" class="btn btn-danger w-100"
                                                                data-bs-dismiss="modal">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- pagination --}}
        <div class="card-footer d-flex align-items-center ms-auto">
            {!! $categories->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}
        </div>
    </div>
    {{-- use ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- when entries number or search input updated --}}
    <script>
        $(document).ready(function() {
            $('#data_count_shows').on('input',function() {
                var count_shows = $(this).val();
                // update the table and the pagination
                $.ajax({
                    url: "{{ route('workspace.category.index') }}",
                    type: 'GET',
                    data: {
                        data_count_shows: count_shows
                    },
                    success: function(response) {
                        var newTable = $(response).find('.datatable');
                        var newPagination = $(response).find('.pagination');
                        $('.datatable').html(newTable.html());
                        $('.pagination').html(newPagination.html());
                    }
                });
            });

            $('#search').on('input',function() {
                var search = $(this).val();
                // update only the table

                $.ajax({
                    url: "{{ route('workspace.category.index') }}",
                    type: 'GET',
                    data: {
                        search: search
                    },
                    success: function(response) {
                        var newTable = $(response).find('.datatable');
                        $('.datatable').html(newTable.html());
                    }
                });
                
            });
        });
    </script>

@endsection
