<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'client'])->group(function () {
    Route::get('/client', [ClientController::class, 'index'])
        ->name('client.index');
    
    Route::get('/client/post/{post}/proposals', [ClientController::class, 'viewProposal'])
        ->name('client.post.proposals');

    Route::post('/client/hire/{proposal}', [ClientController::class, 'hire'])
        ->name('client.hire.freelancer');

    Route::get('/posts', [PostController::class, 'index'])
        ->name('posts.index');

    Route::get('/post/create', [PostController::class, 'create'])
        ->name('post.create');

    Route::post('/posts', [PostController::class, 'store'])
        ->name('posts.store');

    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
        ->name('posts.edit');

    Route::get('/posts/{post}', [PostController::class, 'show'])
        ->name('posts.show');

    Route::patch('/posts/{post}', [PostController::class, 'update'])
        ->name('posts.update');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->name('posts.delete');
});
