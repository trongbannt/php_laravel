<section>
    <header>
        <h3>Update Password</h3>
        <p>Ensure your account is using a long, random password to stay secure.</p>
    </header>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')
        <div>
            <input type="password" id="current_password" name="current_password" placeholder="Current Password"
                class="form-control {{ $errors->updatePassword->has('current_password') ?'is-invalid':'' }}">
            @if($errors->updatePassword->has('current_password'))
                 <div class="text-danger">{{ $errors->updatePassword->first('current_password')}}</div>
            @endif
        </div>
        <div class="mt-3">
            <input type="password" id="new_password" name="new_password" placeholder="New Password"
                class="form-control {{ $errors->updatePassword->has('new_password') ?'is-invalid':'' }}">
            @if($errors->updatePassword->has('new_password'))
                <div class="text-danger">{{ $errors->updatePassword->first('new_password') }}</div>
            @endif
        </div>

        <div class="mt-3">
            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation"
                class="form-control" placeholder="Confirm Password">
        </div>

        <div class="mt-3 d-flex">
            <button type="submit" class="btn btn-secondary">Save</button>
            @if (session('status') === 'password-updated')
                <span class="text-success align-self-center pl-3" id="status_upate_password">Saved success</span>
            @endif
        </div>
    </form>
</section>

