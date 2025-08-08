        <?php

        // use App\Http\Controllers\PostController;    
        // use App\Http\Controllers\UserController;
        // use Illuminate\Support\Facades\Route;
        // use Illuminate\Support\Facades\Auth;
        // use App\Models\Post;
        
        // Route::get('/', function () {
        // $posts = Post::latest()->get();
        // return view('home', ['posts' => $posts]);
        // });



        // Route::post('/register', [UserController::class, 'register']); 
        // Route::post('/logout', [UserController::class, 'logout']);
        // Route::post('/login', [UserController::class, 'login']);

        // Route::post('/create-post', [PostController::class, 'createPost']);
        // Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
        // Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
        // Route::delete('/edit-post/{post}', [PostController::class, 'deletePost']);

        use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

// Homepage untuk semua orang
Route::get('/', function () {
    return view('home');
});

// Halaman Register & Login
Route::view('/register', 'register');
Route::view('/login', 'login');

// Akses POST hanya untuk user yang login
Route::middleware('auth')->group(function () {
    Route::get('/post', function () {
        $posts = Post::latest()->get();
        return view('post', ['posts' => $posts]);
    });

    Route::post('/create-post', [PostController::class, 'createPost']);
    Route::post('/logout', [UserController::class, 'logout']);
});

// Proses auth
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
