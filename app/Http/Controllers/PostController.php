<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\direct;

class PostController extends Controller
{

   public function deletePost(Post $post){

    $user = auth()->user();

    // Hanya boleh hapus kalau: pemilik post ATAU admin
    if ($user->id !== $post->user_id && !$user->isAdmin()) {
        abort(403, 'Akses ditolak: bukan pemilik atau admin.');
    }

    $post->delete();
    return redirect('/')->with('message', 'Post dihapus.');
}

    public function showEditScreen(Post $post){
    if (auth()->user()->id !== $post->user_id) {
        return redirect('/');
    }
    return view('edit-post', ['post' => $post]);
}

public function actuallyUpdatePost(Post $post, Request $request){
    if (auth()->user()->id !== $post->user_id) {
        return redirect('/');
    }

    $incomingFields = $request->validate([
        'title' => 'required',
        'body' => 'required'
    ]);

    $incomingFields['title'] = strip_tags($incomingFields['title']);
    $incomingFields['body'] = strip_tags($incomingFields['body']);

    $post->update($incomingFields);
    return redirect('/');
}



    public function createPost(Request $request){
        $incomingFields= $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = Auth::id();
        Post::create($incomingFields);

        return redirect('/');
    }
}
