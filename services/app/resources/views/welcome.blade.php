@extends('layouts.app')

@section('content')
    <div class="container">
        @if(\Session::has('success'))
            <div class="alert alert-success">
                {{\Session::get('success')}}
            </div>
        @endif

        <div class="row">
            <a href="{{route('articles.create')}}" class="btn btn-success">Create Article</a>
            <a href="{{route('articles.index')}}" class="btn btn-default">All Articles</a>
        </div>
    </div>
@endsection
