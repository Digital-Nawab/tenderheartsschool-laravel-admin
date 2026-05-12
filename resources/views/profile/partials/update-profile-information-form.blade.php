<section class="card shadow-sm">
    <div class="card-body">

        <h5 class="card-title mb-3">Profile Information</h5>
        <p class="text-muted">
            Update your account's profile information and email address.
        </p>

        <!-- Email Verification Form (Hidden) -->
        <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <!-- Main Form -->
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name', $user->name) }}" required autofocus>

                @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email', $user->email) }}" required>

                @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Verification Notice -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning">
                    Your email address is unverified.

                    <button form="send-verification" class="btn btn-link p-0 ms-2">
                        Click here to re-send verification email
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <div class="text-success mt-2">
                            Verification link sent successfully!
                        </div>
                    @endif
                </div>
            @endif

            <!-- Submit -->
            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>

                @if (session('status') === 'profile-updated')
                    <span class="text-success">Profile updated successfully!</span>
                @endif
            </div>

        </form>
    </div>
</section>