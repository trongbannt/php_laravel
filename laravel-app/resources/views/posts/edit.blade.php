@extends('layout.app')

@section('content')
    <h1>Edit Post</h1>
    <form action="/posts/{{ $postEdit->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input type="text" class="form-control" value="{{ $postEdit->title }}" id="title" name="title"
                placeholder="">
        </div>
        <div class="form-group mb-3">
            <label for="body">Content</label>
            <textarea class="form-control" id="body" name="body" rows="3">{{ $postEdit->body }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-3" value="">Save</button>
    </form>
@endsection
