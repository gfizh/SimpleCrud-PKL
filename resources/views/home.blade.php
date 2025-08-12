<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HomePage</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="bg-wrapper"></div>  

<main>
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
            <h2 class="judul">Anda belum login</h2>
            <button class="nav-btn" onclick="window.location.href='{{ route('login') }}'">Login</button>
            <button class="nav-btn" onclick="window.location.href='{{ route('register') }}'">Register</button>
        </div>
    @endauth
</main>

<footer>
    &copy; {{ date('Y') }} Ahmad Hafizh, powered by Laravel 🚀
</footer>

<script>
    const wrapper = document.querySelector('.bg-wrapper');

    // Bintang jatuh
    const starCount = 35;
    for (let i = 0; i < starCount; i++) {
        const star = document.createElement('div');
        star.classList.add('star');
        star.style.left = Math.random() * 100 + 'vw';
        star.style.animationDuration = (Math.random() * 5 + 5) + 's';
        star.style.animationDelay = (Math.random() * 5) + 's';
        wrapper.appendChild(star);
    }

    // Partikel merah
    const particleCount = 50;
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        particle.style.left = Math.random() * 100 + 'vw';
        particle.style.top = Math.random() * 100 + 'vh';
        particle.style.animationDuration = (Math.random() * 10 + 5) + 's';
        particle.style.animationDelay = (Math.random() * 5) + 's';
        wrapper.appendChild(particle);
    }
</script>

</body>
</html>
