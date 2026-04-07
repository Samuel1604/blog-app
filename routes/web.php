<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('welcome');
// })->name('home');

// Route::middleware(['auth'])->group(function () {
//     Route::get('dashboard', function () {
//         return Inertia::render('dashboard');
//     })->name('dashboard');
// });

// require __DIR__.'/settings.php';
// require __DIR__.'/auth.php';

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/create', [PostController::class, 'create'])->name('post.create');
Route::post('/store', [PostController::class, 'store'])->name('post.store');
Route::get('/show/{id}', [PostController::class, 'show'])->name('post.show');
Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
Route::put('/update/{id}', [PostController::class, 'update'])->name('post.update');
Route::post('/comment', [CommentController::class, 'store'])->name('post.comment');
Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('post.destroy');
Route::delete('/comment/delete/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');