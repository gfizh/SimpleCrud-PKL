<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link rel="stylesheet" href="/css/edit.css">
</head>
<body>

    <!-- Background -->
    <div class="bg-wrapper"></div>

    <!-- Konten -->
    <div class="container">
        <h2>Edit Post</h2>
        <form action="/edit-post/{{ $post->id }}" method="POST" class="edit-form">
            @csrf
            @method('PUT')
            <input type="text" name="title" value="{{ $post->title }}" required>
            <textarea name="body" rows="6" required>{{ $post->body }}</textarea>
            <button type="submit">💾 Simpan Perubahan</button>
        </form>
    </div>

</body>
</html>
