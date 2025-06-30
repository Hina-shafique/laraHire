<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProposalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'freelancer'])->group(function () {
    Route::get('/freelancer', [FreelancerController::class, 'index'])->name('freelancer.index');

    Route::get('/freelancer/posts', [PostController::class, 'explore'])->name('freelancer.explore');
    Route::get('freelancer/posts/{post}', [PostController::class, 'display'])->name('freelancer.display');

    Route::get('/posts/{post}/proposal/create', [ProposalController::class, 'create'])->name('proposal.create');
    Route::post('/posts/{post}/proposal', [ProposalController::class, 'store'])->name('proposal.store');
});

require __DIR__ . '/auth.php';
require __DIR__. '/client.php';
