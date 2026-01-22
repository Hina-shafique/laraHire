<?php

use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\SubmitworkController;
use Illuminate\Support\Facades\Route;

Route::controller(FreelancerController::class)
    ->prefix('freelancer')
    ->group(function () {

        Route::get('/', 'index')
            ->name('freelancer.index');

        Route::get('/active-jobs', 'active')
            ->name('freelancer.active');

        Route::get('/rate-client/{post}', 'rateClient')
            ->name('rateClient');

        Route::post('/submit-rating/{post}', 'submitRating')
            ->name('freelancer.submit.rating');
    });

Route::middleware(['auth', 'freelancer'])
    ->name('freelancer.')
    ->prefix('freelancer')
    ->controller(PostController::class)
    ->group(function () {

        Route::get('/posts', 'explore')
            ->name('explore');

        Route::get('/posts/{post}', 'display')
            ->name('display');
    });

Route::controller(ProposalController::class)
    ->name('proposal.')
    ->group(function () {

        Route::get('/posts/{post}/proposal/create', 'create')
            ->name('create');

        Route::get('/posts/{post}/proposal/generate', 'generate')
            ->name('generate');

        Route::post('/posts/{post}/proposal', 'store')
            ->name('store');

        Route::get('/proposals', 'index')
            ->name('index');
    });

Route::get('/submit-work/{post}', [SubmitworkController::class, 'create'])
    ->name('submit.work');

Route::post('/submit-work/{post}', [SubmitworkController::class, 'store'])
    ->name('submit.store');

