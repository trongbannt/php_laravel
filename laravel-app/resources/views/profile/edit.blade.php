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
                    @include('profile.partials.update-password-form')

                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                <div class="col-sm-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#status_upate_profile').hide();
            }, 3000);

            setTimeout(function() {
                $('#status_upate_password').hide();
            }, 3000);

            showErrorDeleteUser();

        });

        /*When delete account fail will show keep modal*/
        function showErrorDeleteUser() {
            var flagShowModalDeleteAccount = document.getElementById("flagShowModalDeleteAccount");
            var hasError = 1;
            if (flagShowModalDeleteAccount.value == hasError) {

                $('#modal_delete_account').modal({
                    show: true,
                    focus:true,
                })
            };
        }
    </script>
@endsection
