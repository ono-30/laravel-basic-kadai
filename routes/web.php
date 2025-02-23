<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// ルーティングを設定するコントローラを宣言する
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/posts', [PostController::class, 'index']);

// '/posts/create'にGETメソッドでアクセス（HTTPリクエストを送信）したときにPostControllerのcreateアクションが実行される
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth');

// '/posts/store'にPOSTメソッドでアクセス（HTTPリクエストを送信）したときにPostControllerのstoreアクションが実行される
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store')->middleware('auth');

// 「/posts/1」のように可変の値を含むURLにアクセスした際、PostControllerのshowアクションが実行されるようルーティングを設定
Route::get('/posts/{id}', [PostController::class, 'show']);
