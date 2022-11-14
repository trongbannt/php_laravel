@extends('layout.app')

@section('content')
    <h1>Add Post</h1>
    <form action="/posts" method="POST" >
        @csrf
        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="">
        </div>
        <div class="form-group mb-3">
            <label for="body">Content</label>
            <textarea class="form-control" id="body" name="body" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-3" value="">Add Post</button>
    </form>
@endsection
