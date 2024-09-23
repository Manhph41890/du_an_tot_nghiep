<form action="{{ route('auth.verifycode') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Your email" required>
    <input type="text" name="code" placeholder="Verification code" required>
    <button type="submit">Verify Code</button>
</form>
