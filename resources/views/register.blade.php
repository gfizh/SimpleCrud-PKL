<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="bg-wrapper"></div>
    <div class="container">
<h2>Register</h2>
<form method="POST" action="/register">
    
    @csrf
    <input type="text" name="name" placeholder="Nama" required>
    <br>
    <input type="email" name="email" placeholder="Email" required>
    <br>
    <input type="password" name="password" placeholder="Password" required>
    <br>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
    <br>
    <button type="submit">Register</button>
</form>
<a href="{{ route('login') }}">Sudah punya akun? Login</a>
</div>
<script>
    const wrapper = document.querySelector('.bg-wrapper');

    // Bintang jatuh
    const starCount = 35; // Lebih sedikit biar soft
    for (let i = 0; i < starCount; i++) {
        const star = document.createElement('div');
        star.classList.add('star');
        star.style.left = Math.random() * 100 + 'vw';
        star.style.animationDuration = (Math.random() * 5 + 5) + 's';
        star.style.animationDelay = (Math.random() * 5) + 's';
        wrapper.appendChild(star);
    }

    // Partikel merah
    const particleCount = 50; // Lebih sedikit biar tidak ramai
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
