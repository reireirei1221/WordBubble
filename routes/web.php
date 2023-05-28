<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthorController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/words/storeFromOutside', [PostController::class, 'storeFromeOutside']);
Route::post('/authors/storeFromOutside', [AuthorController::class, 'storeFromeOutside']);

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/words/index', 'index')->name('words/index');
    Route::post('/words/store', 'store')->name('words/store');
    Route::get('/words/create', 'create')->name('words/create');
    Route::get('/words/deleteAll', 'deleteAll')->name('words/deleteAll');
    Route::get('/words/{word}', 'show')->name('words/show');
    Route::get('/words/{word}/edit', 'edit')->name('words/edit');
});

Route::controller(AuthorController::class)->middleware(['auth'])->group(function(){
    Route::get('/authors/index', 'index')->name('authors/index');
    Route::post('/authors/store', 'store')->name('authors/store');
    Route::get('/authors/create', 'create')->name('authors/create');
    Route::get('/authors/deleteAll', 'deleteAll')->name('authors/deleteAll');
    Route::get('/authors/{author}', 'show')->name('authors/show');
    Route::get('/authors/{author}/edit', 'edit')->name('authors/edit');
});

require __DIR__.'/auth.php';
