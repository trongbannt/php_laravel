@extends('layout.app')

@section('content')
    <div class="mt-3 mb-3">
        <h1>Detial Food</h1>
    </div>
    <div>
        <a href="/foods" class="btn btn-secondary mb-3" value="">Back</a>
        <div class="form-group mb-3">
            <label for="title">Name</label>
            <input type="text" class="form-control" disabled value="{{ $food->name }}" id="name" name="name">
        </div>
        <div class="form-group mb-3">
            <label for="title">Count</label>
            <input type="text" class="form-control" disabled value="{{ $food->count }}" id="count" name="count">
        </div>
        <div class="form-group mb-3">
            <label for="title">Count</label>
            <input type="text" class="form-control" disabled value="{{ $food->count }}" id="count" name="count">
        </div>
        <div class="form-group mb-3">
            <label for="title">Category</label>
            <input type="text" class="form-control" disabled value="{{ $food->category->name }}" id="category" name="category">
        </div>
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" disabled name="description" rows="3">{{ $food->description }}</textarea>
        </div>

        <div class="form-group mb-3">
            <img src="{{ asset('images/' . $food->image_path)  }}" class="img-thumbnail" width="200px" height="200px" >
        </div>
    </div>
@endsection
