<section>
    <header>
        <h3>Delete Account</h3>
        <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your
            account, please download any data or information that you wish to retain</p>
    </header>

    <a class="btn btn-danger delete_account " data-toggle="modal" data-target="#modal_delete_account">
        DELETE ACCOUNT
    </a>

    <!-- Modal delete -->
    <input type="text" id="flagShowModalDeleteAccount" hidden value="{{ $errors->userDeletion->isNotEmpty() }}" />
    <div class="modal fade" id="modal_delete_account" tabindex="-1" role="dialog" aria-hidden="true">
        <form id="delete-user-form" action="{{ route('profile.destroy') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure your want to delete your account?
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Once your account is deleted, all of its resources and data will be permanently deleted.
                            Please enter your password to confirm you would like to permanently delete your account.</p>
                        <div>
                            <input type="password" id="password" name="password" placeholder="Password" autofocus
                                class="form-control {{ $errors->userDeletion->has('password') ? 'is-invalid' : '' }}">
                            @if ($errors->userDeletion->has('password'))
                                <div class="text-danger">{{ $errors->userDeletion->first('password') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-danger">DELETE ACCOUNT</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
