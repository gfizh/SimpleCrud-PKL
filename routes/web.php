        <?php

        use App\Http\Controllers\PostController;    
        use App\Http\Controllers\UserController;
        use Illuminate\Support\Facades\Route;
        use Illuminate\Support\Facades\Auth;
        use App\Models\Post;
        
        Route::get('/', function () {
        $posts = Post::latest()->get();
        return view('home', ['posts' => $posts]);
        });



        Route::post('/register', [UserController::class, 'register']); 
        Route::post('/logout', [UserController::class, 'logout']);
        Route::post('/login', [UserController::class, 'login']);

        Route::post('/create-post', [PostController::class, 'createPost']);
        Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
        Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
        Route::delete('/edit-post/{post}', [PostController::class, 'deletePost']);
    

