@extends('layout.app')

@section('content')
    <div class="mt-3 mb-3">
        <h1>Update Food</h1>
    </div>
    <form action="/foods/{{ $food->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="title">Name</label>
            <input type="text" class="form-control" value="{{ $food->name }}" id="name" name="name"
                placeholder="Enter food's name">
        </div>
        <!--image-->
        <div class="form-group mb-3">
            <img src="{{ asset('images/' . $food->image_path) }}" id="show_image" class="img-thumbnail" width="200px"
                height="200px">
        </div>
        <div class="input-group mb-3">
            <input type="file" id="input_file_image" name="image" value="{{ $food->image_path }}"
                accept="image/png, image/jpg, image/jpeg"
                onchange="document.getElementById('show_image').src = window.URL.createObjectURL(this.files[0])">
        </div>

        <div class="form-group mb-3">
            <label for="title">Count</label>
            <input type="text" class="form-control" value="{{ $food->count }}" id="count" name="count"
                placeholder="Enter food's count">
        </div>
        <div class="form-group mb-3">
            <label for="category_id">Category</label>
            <select class="custom-select" name="category_id">
                <option value="">--Choose a categories--</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $food->category_id == $category->id ? "selected='selected'" : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"
                placeholder="Enter food's description">{{ $food->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mb-3" value="">Save</button>
        <a href="/foods" class="btn btn-secondary mb-3" value="">Back</a>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            console.log('document ready');
            // $("#input_file_image").change(function() {
            //     console.log(' input_file_image change');
            //     console.log(this.files);
            //     $('#show_image').attr('src','bird.jpg');
            // });
        });
    </script>
@endsection
