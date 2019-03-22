@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br/>
        @endif
        <div class="row">
            <form method="post" action="{{route('articles.store')}}">
                <div class="form-group">
                    {{csrf_field()}}
                    <label>
                        Article Name:
                        <input type="text" class="form-control" name="name"/>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        Image URI
                        <input type="text" class="form-control" name="image"/>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        Article Body:
                        <textarea cols="19" rows="5" class="form-control" name="body"></textarea>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
