@extends('layout.app')

@section('content')
    <div class="mt-3 mb-3">
        <h1>This page foods</h1>
    </div>
    <div>

        @if (Session::has('message'))
            @php
                $typeMessage = Session::get('type');
            @endphp
            @if ($typeMessage == 'success')
                <div class="alert alert-success" id="alert_success" role="alert">
                    {{ Session::get('message') }}
                </div>
            @else
                <div class="alert alert-danger" id="" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif
        @endif

        <a href="/foods/create" type="button" class="btn btn-primary mb-3">Add food</a>
        <div class="table-responsive-md">
            <table class="table table-hover">
                <thead class="text-center">
                    <tr class="">
                        <th class="col-1" scope="col">#</th>
                        <th class="col-2 text-center" scope="col">Name</th>
                        <th class="col-1" scope="col">Count</th>
                        <th class="col-3" scope="col">Description</th>
                        <th class="col-3" scope="col">Category</th>
                        <th class="col-1" scope="col"></th>
                        <th class="col-1 text-left" scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $numRow = 0;
                    @endphp
                    @foreach ($foods as $item)
                        @php
                            $numRow++;
                        @endphp
                        <tr class="text-center">
                            <td>{{ $numRow }}</td>
                            <td>
                                <a href="/foods/{{ $item->id }}" class="text-decoration-none">{{ $item->name }}</a>
                            </td>
                            <td>{{ $item->count }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td class="text-right" style="padding-right: 0"><a href="/foods/{{ $item->id }}/edit" class="btn btn-primary">Edit</a></td>
                            <td class="text-left">
                                <a class="btn btn-danger delete_food " data-idFood="{{ $item->id }}" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal delete -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="{{ route('foods.destroy', 'id') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <input id="id-food" name="id" hidden value="">
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

    <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
        <div class="toast" style="position: absolute; top: 0; right: 0;">
            <div class="toast-header">
                <img src="..." class="rounded mr-2" alt="...">
                <strong class="mr-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            console.log('document ready');
            $(".delete_food").click(function() {
                console.log('.delete_food click');
                let id = $(this).attr('data-idFood');
                $('#id-food').val(id);
            });

            setTimeout(function() {
                // Closing the alert
                $('.alert').alert('close');
            }, 3000);
        });
    </script>
@endsection
