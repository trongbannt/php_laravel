@extends('layout.app')

@section('content')
    <h1>This is page index of PostsController</h1>
    <div>
        <a href="/posts/create" type="button" class="btn btn-primary mb-3">Add Post</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Body</th>
                </tr>
            </thead>
            <tbody>
                <?php $numRow = 0; ?>
                @foreach ($posts as $item)
                    <?php $numRow++; ?>
                    <tr>
                        <th scope="row">{{ $numRow }}</th>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->body }}</td>
                        <td>
                            <a href="/posts/{{ $item->id }}/edit" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            @php($idPost = $item->id)
                            <button id="delete-post" type="button" class="btn btn-danger "
                                data-idPost="{{ $item->id }}" data-toggle="modal" data-target="#exampleModal">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal delete -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="{{ route('posts.destroy', 'id') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <input id="id-post" name="id" hidden value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            console.log('document ready');
            $("#delete-post").click(function() {
                console.log('.delete-post click');
                let id = $(this).attr('data-idPost');
                $('#id-post').val(id);
            });
        });
    </script>
@endsection
