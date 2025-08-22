<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Import model Post (tabel posts)
use Illuminate\Support\Facades\Auth;
use App\Models\direct; // (sepertinya belum dipakai di sini)

class PostController extends Controller
{

   // -------------------------
   // FUNGSI HAPUS POST
   // -------------------------
   public function deletePost(Post $post){

      $user = auth()->user(); // ambil user yang sedang login

      // Hanya boleh hapus kalau: pemilik post ATAU admin
      if ($user->id !== $post->user_id && !$user->isAdmin()) {
          abort(403, 'Akses ditolak: bukan pemilik atau admin.');
      }

      // Hapus post dari database
      $post->delete();

      // Redirect ke home dengan pesan sukses
      return redirect('/')->with('message', 'Post dihapus.');
   }


   // -------------------------
   // FUNGSI TAMPILKAN HALAMAN EDIT POST
   // -------------------------
   public function showEditScreen(Post $post){
      // Cek: hanya pemilik post yang boleh akses halaman edit
      if (auth()->user()->id !== $post->user_id) {
          return redirect('/'); // kalau bukan pemilik, kembalikan ke home
      }

      // Tampilkan view edit-post.blade.php dengan data post
      return view('edit-post', ['post' => $post]);
   }


   // -------------------------
   // FUNGSI UPDATE POST (SETELAH EDIT)
   // -------------------------
   public function actuallyUpdatePost(Post $post, Request $request){
      // Cek: hanya pemilik post yang boleh update
      if (auth()->user()->id !== $post->user_id) {
          return redirect('/');
      }

      // Validasi input edit
      $incomingFields = $request->validate([
          'title' => 'required', // judul wajib diisi
          'body' => 'required'   // isi wajib diisi
      ]);

      // Bersihkan input dari tag HTML berbahaya (XSS protection)
      $incomingFields['title'] = strip_tags($incomingFields['title']);
      $incomingFields['body'] = strip_tags($incomingFields['body']);

      // Update post di database
      $post->update($incomingFields);

      // Redirect ke home setelah berhasil update
      return redirect('/');
   }


   // -------------------------
   // FUNGSI BUAT POST BARU
   // -------------------------
   public function createPost(Request $request){
      // Validasi input post baru
      $incomingFields = $request->validate([
          'title' => 'required', // judul wajib
          'body' => 'required',  // isi wajib
      ]);

      // Bersihkan input dari tag HTML
      $incomingFields['title'] = strip_tags($incomingFields['title']);
      $incomingFields['body'] = strip_tags($incomingFields['body']);

      // Tambahkan user_id = user yang sedang login
      $incomingFields['user_id'] = Auth::id();

      // Simpan ke database
      Post::create($incomingFields);

      // Kembali ke home
      return redirect('/');
   }
}
