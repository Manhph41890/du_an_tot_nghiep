<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div>
        <label for="ho_ten">Full Name</label>
        <input type="text" id="ho_ten" name="ho_ten" value="{{ old('ho_ten') }}" required>
        @error('ho_ten')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Phone Number -->
    <div>
        <label for="so_dien_thoai">Phone Number</label>
        <input type="text" id="so_dien_thoai" name="so_dien_thoai" value="{{ old('so_dien_thoai') }}" required>
        @error('so_dien_thoai')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password -->
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        @error('password_confirmation')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Register</button>
</form>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
