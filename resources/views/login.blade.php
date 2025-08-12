<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="/css/style.css">
</head>


<body>
    <div class="bg-wrapper"></div>
    <div class="container">
<h2>Login</h2>
<form method="POST" action="/login">
    @csrf
    <input type="email" name="loginname" placeholder="Email" required>
    <br>
    <input type="password" name="loginpassword" placeholder="Password" required>
    <br>
    <button type="submit">Login</button>
</form>
<a href="{{ route('register') }}">Belum punya akun? Register</a>
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
