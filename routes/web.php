<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PaperController;

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

Route::get('/words/store-from-outside', [PostController::class, 'store_from_outside']);
Route::get('/papers/store-from-outside', [PaperController::class, 'store_from_outside']);

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/words/index', 'index')->name('words/index');
    Route::get('/words/part-of-speech/{part_of_speech}', 'filter_by_part_of_speech')->name('words/part-of-speech/{part_of_speech}');
    Route::post('/words/store', 'store')->name('words/store');
    Route::get('/words/create', 'create')->name('words/create');
    Route::get('/words/delete-all', 'delete_all')->name('words/delete-all');
    Route::get('/words/{word}', 'show')->name('words/show');
    Route::get('/words/{word}/edit', 'edit')->name('words/edit');
});

Route::controller(AuthorController::class)->middleware(['auth'])->group(function(){
    Route::get('/authors/index', 'index')->name('authors/index');
    Route::post('/authors/store', 'store')->name('authors/store');
    Route::get('/authors/create', 'create')->name('authors/create');
    Route::get('/authors/delete-all', 'delete_all')->name('authors/delete-all');
    Route::get('/authors/{author}', 'show')->name('authors/show');
    Route::get('/authors/{author}/edit', 'edit')->name('authors/edit');
});

Route::controller(PaperController::class)->middleware(['auth'])->group(function(){
    Route::get('/papers/index', 'index')->name('papers/index');
    Route::post('/papers/store', 'store')->name('papers/store');
    Route::get('/papers/create', 'create')->name('papers/create');
    Route::get('/papers/delete-all', 'delete_all')->name('papers/delete-all');
    Route::get('/papers/{paper}', 'show')->name('papers/show');
    Route::get('/papers/{paper}/edit', 'edit')->name('papers/edit');
});

require __DIR__.'/auth.php';
