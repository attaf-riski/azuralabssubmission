@extends('template')

@php
    $title = "Ataf's Book Management";
@endphp

@php
    $pretitle = 'dashboard';
@endphp

@section('body')
    <div>
        <h1>Hello, {{ Auth::user()->name }}</h1>
        <p>Welcome to Ataf's Book Management. You can manage your book and book categories here.</p>
        <p>This project is for azura labs submission for intership software engineer.</p>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Manage Your Book</h3>
                    <p class="text-muted">Doa Lorem ipsum moloran mit amit, consectetur adipisicing elit. Aperiam deleniti fugit
                        incidunt, iste, itaque minima
                        neque pariatur perferendis sed suscipit velit vitae voluptatem. Abracadabra.</p>
                </div>
                <!-- Card footer -->
                <div class="card-footer">
                    <a href="{{route('workspace.book.index')}}" class="btn btn-primary">Go Manage</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Manage Your Book Categories</h3>
                    <p class="text-muted">Doa Lorem ipsum moloran mit amit, consectetur adipisicing elit. Aperiam deleniti fugit
                        incidunt, iste, itaque minima
                        neque pariatur perferendis sed suscipit velit vitae voluptatem. Abracadabra.</p>
                </div>
                <!-- Card footer -->
                <div class="card-footer">
                    <a href="{{route('workspace.category.index')}}" class="btn btn-primary">Go Manage</a>
                </div>
            </div>
        </div>
    </div>
@endsection
