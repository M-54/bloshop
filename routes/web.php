<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', \App\Http\Controllers\HomeController::class);

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

Route::get('posts/{post}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::group([
    'middleware' => 'auth'
], function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::resource('posts', \App\Http\Controllers\PostController::class)
        ->except(['show']);

    Route::get('catag', [\App\Http\Controllers\CatagController::class, 'index'])->name('catag.index');
    Route::get('catag/create', [\App\Http\Controllers\CatagController::class, 'create'])->name('catag.create');
    Route::post('catag', [\App\Http\Controllers\CatagController::class, 'store'])->name('catag.store');

    Route::resource('categories', \App\Http\Controllers\CategoryController::class)
        ->except(['index', 'create', 'store']);
    Route::resource('tags', \App\Http\Controllers\TagController::class)
        ->except(['index', 'create', 'store']);

    Route::resource('comments', \App\Http\Controllers\CommentController::class)
        ->except(['create']);
});

require __DIR__ . '/auth.php';
