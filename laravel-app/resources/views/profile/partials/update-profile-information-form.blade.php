<section>
    <header>
        <h3>Profile Information</h3>
        <p>Update your account's profile information and email address.</p>
    </header>

    {{-- <form id="send-verification" method="post" action="">
        @csrf
    </form> --}}

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')
        <div>
            <input type="text" id="name" name="name" value="{{ $user->name }}" placeholder="Name"
                class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-3">
            <input type="email" id="email" name="email" placeholder="Email" value="{{ $user->email }}"
                class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-3 d-flex">
            <button type="submit" class="btn btn-secondary">Save</button>
            @if (session('status') === 'profile-updated')
                <span class="text-success align-self-center pl-3" id="status_upate_profile">Saved success</span>
            @endif
        </div>
    </form>
</section>

