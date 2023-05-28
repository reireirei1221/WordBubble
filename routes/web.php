<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\AuthorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index']);
Route::get('/authors/index', [AuthorController::class, 'index']);
Route::post('/posts',  [PostController::class, 'store']);
Route::get('/words',  [PostController::class, 'store_word']);
Route::post('/authors', [AuthorController::class, 'store_author_outside']);
// Route::post('/authors_outside', [AuthorController::class, 'store_author_outside']);
Route::get('/posts/create',  [PostController::class, 'create']);
Route::get('/authors/create',  [AuthorController::class, 'create']);
Route::get('/posts/deleteAll',  [PostController::class, 'delete_all']);
Route::get('/authors/deleteAll',  [AuthorController::class, 'delete_all']);
Route::get('/posts/{word}',  [PostController::class, 'show']);
// Route::put('/posts/{post}',  [PostController::class, 'update']);
Route::delete('/posts/{post}',  [PostController::class, 'delete']);
Route::get('/posts/{post}/edit',  [PostController::class, 'edit']);
Route::get('/categories/{category}', [CategoryController::class,'index']);
