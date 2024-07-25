<?php

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

Route::get('/posts', [PostController::class, 'index']);

// 「/posts/1」のように可変の値を含むURLにアクセスした際、PostControllerのshowアクションが実行されるようルーティングを設定
Route::get('/posts/{id}', [PostController::class, 'show']);
