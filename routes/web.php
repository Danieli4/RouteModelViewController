<?php

use App\RMVC\Route\Route;

echo 2222;

//Route::get('/posts', [PostController::class, 'index'])->name()->middleware();
Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
