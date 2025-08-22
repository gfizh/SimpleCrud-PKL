<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForumAhmad - Login</title>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <div class="bg-wrapper"></div>
    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="/login">
            @csrf
            <input type="email" name="loginname" placeholder="Email" required>
            <input type="password" name="loginpassword" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="{{ route('register') }}" class="alt-link">Belum punya akun? Register</a>
    </div>
</body>
</html>
