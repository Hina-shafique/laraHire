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

    Route::get('/client/active-jobs', [ClientController::class, 'activejobs'])
        ->name('client.active.jobs');

    Route::post('client/submit-confirm/{post}', [ClientController::class, 'submitConfirm'])
        ->name('submitConfirm');

    Route::get('/client/rate-freelancer/{post}', [ClientController::class, 'rateFreelancer'])
        ->name('rateFreelancer');

    Route::post('client/submit-rating/{post}', [ClientController::class, 'submitRating'])
        ->name('client.submit.rating');

});

Route::post('/post/generate', [PostController::class, 'generate'])
    ->name('post.generate');

Route::resource('post', PostController::class)->names('posts');
