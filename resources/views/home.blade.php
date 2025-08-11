<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

@auth
    <div class="container">
        <h2>Selamat datang, {{ auth()->user()->name }}</h2>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="container">
        <h2>Buat Post Baru</h2>
        <form action="/create-post" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Judul post" required>
            <textarea name="body" placeholder="Isi post..." rows="5" required></textarea>
            <button type="submit">Simpan Post</button>
        </form>
    </div>

    <div class="container">
        <h2>Semua Post</h2>
        @foreach($posts as $post)
    <div class="post-card" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <p><strong>Posted by:</strong> {{ $post->user->name }}</p>

        <h3>{{ $post->title }}</h3>
        <p>{{ $post->body }}</p>

        @if(auth()->check() && (auth()->id() === $post->user_id || auth()->user()->isAdmin()))
            <form action="/edit-post/{{ $post->id }}" class="inline-form" method="GET">
                <button>Edit</button>
            </form>
            <form action="/edit-post/{{ $post->id }}" method="POST" class="inline-form" style="margin-left: 10px;">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Yakin hapus post ini?')">Delete</button>
            </form>
        @endif
    </div>
@endforeach

    </div>
@else
   <div class="fullscreen-center">
    <div class="container">
        <h2>Form Register</h2>
        <form method="POST" action="/register">
            @csrf
            <input type="text" name="name" placeholder="Nama" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
    </div>

    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="/login">
            @csrf
            <input type="email" name="loginname" placeholder="Email" required>
            <input type="password" name="loginpassword" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</div>
@endauth
<footer>
    &copy; {{ date('Y') }} Ahmad Hafizh, powered by Laravel 🚀
</footer>

</body>
</html>
