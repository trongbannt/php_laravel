@extends('layout.app')

@section('content')
<h1>This page Products index</h1>
<h2>List Phone</h2>
<div>
    <ul>
        @foreach ($dataPhone as $phone)
            <h3>
                <ul>
                    <li>{{ $phone["name"] }}</li>
                    <li>{{ $phone["year"] }}</li>
                    <li>{{ $phone["price"] }}</li>
                </ul>
            </h3>
        @endforeach
    </ul>
</div>
@endsection