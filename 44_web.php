<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home1');
})->name('home');

#Route::resource('articles', ArticleController::class)->only(['index','show']);
Route::resource('articles', ArticleController::class)->except(['edit','update']);

// Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
// Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
// Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');

Route::middleware('auth')-> group(function() {

    Route::controller(PostController::class)->group(function(){
        Route::get('/posts/create', 'create')->name('posts.create');
        Route::post('/posts', 'store')->name('posts.store');
        Route::get('/posts/search', 'search')->name('posts.search');
        Route::get('/posts/{id}/edit', 'edit')->name('posts.edit');
        Route::put('/posts/{id}', 'update')->name('posts.update');
        Route::delete('/posts/{id}', 'destroy')->name('posts.destroy');
    });

});

Route::controller(PostController::class)->group(function(){
    Route::get('/posts', 'index')->name('posts.index');
    Route::get('/posts/{id}', 'show')->name('posts.show');
});


Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::middleware('guest')-> group(function() {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');



// Route::get('/about', function () {
//     return view('about1');
// })->name('about');
Route::get('/about', AboutController::class)->name('about');


// Route::get('/profile', function() {
//     $role = 'user';
//     $point = 90;
//     return view('profile', ['role' => $role,'point' => $point,]);
// });
// Route::get('/profile', function() {
//     $role = 'user';
//     $point = 90;
//     return view('profile', compact('role', 'point'));
// });
Route::get('/profile', function() {
    $role = 'user';
    $point = 90;
    return view('profile')
        ->with('role', $role)
        ->with('point', $point);
});


Route::get('/notice', function() {
    $notices = [];
    return view('notice', [
        'notices' => $notices,
    ]);    
});

Route::get('/members', function() {
    $members = [
        ['name' => '홍길동', 'email' => 'hong@example.com'],
        ['name' => '이순신', 'email' => 'lee@example.com'],
        ['name' => '강감찬', 'email' => 'kang@example.com'],
    ];
    return view('members', [
        'members' => $members,
    ]);    
});

// Route::get('/posts', function() {
//     $posts = [
//         ['title' => '첫 번째 게시글', 'writer' => '홍길동'],
//         ['title' => '두 번째 게시글', 'writer' => '김철수'],
//         ['title' => '세 번째 게시글', 'writer' => '강호동'],
//     ];
//     return view('posts', compact('posts'));    
// })->name('posts.index');


// Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
// Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

