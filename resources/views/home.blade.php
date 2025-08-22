<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ahmad Forum</title>
    <link rel="stylesheet" href="/css/home.css">
</head>
<body>

<div class="bg-wrapper"></div>  

<header>
    <div class="navbar">
        <h1 class="logo">Ahmad Forum</h1>
        <nav>
            @auth
                <form method="POST" action="/logout" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-btn">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-btn">Login</a>
                <a href="{{ route('register') }}" class="nav-btn">Register</a>
            @endauth
        </nav>
    </div>
</header>

<main>
    @auth
        <div class="container">
            <h2>Selamat datang, {{ auth()->user()->name }}</h2>
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
                <div class="post-card">
                    <p>
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=random&color=fff&size=32" 
                             alt="{{ $post->user->name }}" 
                             style="border-radius: 50%; vertical-align: middle; margin-right: 8px;">
                        <strong>{{ $post->user->name }}</strong>
                    </p>
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->body }}</p>

                    @if(auth()->id() === $post->user_id || auth()->user()->isAdmin())
                        <form action="/edit-post/{{ $post->id }}" method="GET" style="display: inline;">
                            <button>Edit</button>
                        </form>
                        <form action="/edit-post/{{ $post->id }}" method="POST" style="display: inline; margin-left: 10px;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus post ini?')">Delete</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="container fullscreen-center">
            <h2 class="judul">Selamat datang di Ahmad Forum</h2>
            <p>Silakan login atau register untuk mulai bergabung 👋</p>
            <button class="nav-btn" onclick="window.location.href='{{ route('login') }}'">Login</button>
            <button class="nav-btn" onclick="window.location.href='{{ route('register') }}'">Register</button>
        </div>
    @endauth
</main>

<footer>
    &copy; {{ date('Y') }} Ahmad Hafizh, powered by Laravel 🚀
</footer>

</body>
</html>
