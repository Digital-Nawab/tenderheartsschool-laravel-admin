<section class="card shadow-sm">
    <div class="card-body">

        <h5 class="card-title mb-3">Update Password</h5>
        <p class="text-muted">
            Ensure your account is using a long, random password to stay secure.
        </p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <!-- Current Password -->
            <div class="mb-3">
                <label class="form-label">Current Password</label>
                <input type="password" name="current_password" class="form-control" required>

                @error('current_password')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- New Password -->
            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" name="password" class="form-control" required>

                @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>

                @error('password_confirmation')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Button -->
            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>

                @if (session('status') === 'password-updated')
                    <span class="text-success">Saved successfully!</span>
                @endif
            </div>

        </form>
    </div>
</section>