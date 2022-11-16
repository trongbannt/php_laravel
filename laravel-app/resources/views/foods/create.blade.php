@extends('layout.app')

@section('content')
    <div class="mt-3 mb-3">
        <h1>Add Food</h1>
    </div>
    {{-- @if ($errors->any())
        <div class="alert alert-danger" id="" role="alert">
            @foreach ($errors->all() as $error)
                <p><span>{{ $error }}</span></p>
            @endforeach
        </div>
    @endif --}}
    <form action="/foods" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="title">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter food's name"
                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!--image-->
        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input"  name="image" id="input_file_image"
                accept="image/png, image/jpg, image/jpeg" aria-describedby="input_file_image">
                <label class="custom-file-label" id="lable_name_image" for="input_file_image">Choose file</label>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="title">Count</label>
            <input type="text" id="count" name="count" placeholder="Enter food's count"
                class="form-control @error('count') is-invalid @enderror" value="{{ old('count') }}">
            @error('count')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="category_id">Category</label>
            <select class="custom-select @error('category_id') is-invalid @enderror"" name="category_id">
                <option value="">--Choose a categories--</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"
                placeholder="Enter food's description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-3" value="">Save</button>
        <a href="/foods" class="btn btn-secondary mb-3" value="">Back</a>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            console.log('document ready');
            $("#input_file_image").change(function() {
                console.log(' input_file_image change');
                $("#lable_name_image").text(this.files[0].name);
            });
        });
    </script>
@endsection
