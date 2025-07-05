<?php

use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\SubmitworkController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'freelancer'])->group(function () {

    Route::get('/freelancer', [FreelancerController::class, 'index'])
        ->name('freelancer.index');

    Route::get('/freelancer/active-jobs', [FreelancerController::class, 'active'])
        ->name('freelancer.active');

    Route::get('/freelancer/posts', [PostController::class, 'explore'])
        ->name('freelancer.explore');

    Route::get('freelancer/posts/{post}', [PostController::class, 'display'])
        ->name('freelancer.display');

    Route::get('/posts/{post}/proposal/create', [ProposalController::class, 'create'])
        ->name('proposal.create');

    Route::post('/posts/{post}/proposal', [ProposalController::class, 'store'])
        ->name('proposal.store');

    Route::get('/proposals', [ProposalController::class , 'index'])
        ->name('proposal.index');

    Route::get('/submit-work/{post}' , [SubmitworkController::class, 'create'])
        ->name('submit.work');

    Route::post('/submit-work/{post}' , [SubmitworkController::class, 'store'])
        ->name('submit.store');

    Route::get('/freelancer/rate-client/{post}', [FreelancerController::class, 'rateClient'])
        ->name('rateClient');

    Route::post('/freelancer/submit-rating/{post}',[FreelancerController::class, 'submitRating'])
        ->name('freelancer.submit.rating');
});