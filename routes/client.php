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

    Route::get('/client/review-submission/{post}', [ClientController::class, 'reviewSubmission'])
        ->name('client.review');

    Route::post('client/submit-confirm/{post}', [ClientController::class, 'submitConfirm'])
        ->name('submitConfirm');

    Route::get('/client/rate-freelancer/{post}', [ClientController::class, 'rateFreelancer'])
        ->name('rateFreelancer');

    Route::post('client/submit-rating/{post}',[ClientController::class, 'submitRating'])
        ->name('client.submit.rating');

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
