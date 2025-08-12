<?php

use App\Http\Controllers\PostController;    
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

// Halaman Home
Route::get('/', function () {
    $posts = Post::latest()->get();
    return view('home', ['posts' => $posts]);
});

// Halaman Form Register
Route::get('/register', function () {
    return view('register');
})->name('register');

// Halaman Form Login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Proses Form
Route::post('/register', [UserController::class, 'register']); 
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// Post CRUD
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
Route::delete('/edit-post/{post}', [PostController::class, 'deletePost']);

    ?>

