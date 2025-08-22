<!DOCTYPE html>
<html>
<head>
    <title>Register - ForumAhmad</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Register</h2>
            <form method="POST" action="/register">
                @csrf
                <input type="text" name="name" placeholder="Nama" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                <button type="submit">Register</button>
            </form>
            <a href="{{ route('login') }}">Sudah punya akun? Login</a>
        </div>
    </div>

    <footer>
        © 2025 <span>ForumAhmad</span> | Powered by Laravel 🚀
    </footer>
</body>
</html>
