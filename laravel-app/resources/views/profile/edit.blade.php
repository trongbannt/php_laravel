@extends('layout.app')

@section('content')
    
    <div class="mb-5 mt-4">
        <div class="">
            <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                <div class="col-sm-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow rounded-lg mt-4 mb-4">
                <div class="col-sm-6">
                    {{-- @include('profile.partials.update-password-form') --}}
                   
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                <div class="col-sm-6">
                    {{-- @include('profile.partials.delete-user-form') --}}
                </div>
            </div>
        </div>
    </div>
@endsection