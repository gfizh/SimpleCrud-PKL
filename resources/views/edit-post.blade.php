<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<!-- Background -->
<div class="bg-wrapper"></div>

<!-- Konten -->
<div class="container">
    <h2>Edit Post</h2>
    <form action="/edit-post/{{ $post->id }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ $post->title }}" required>
        <textarea name="body" rows="6" required>{{ $post->body }}</textarea>
        <button type="submit">Simpan Perubahan</button>
    </form>
</div>

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
