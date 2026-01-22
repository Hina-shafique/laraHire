<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Client;

Route::redirect('/', '/register');

Route::get('/client.json', function (Client $client) {
   return response()->streamJson([
    'client' => Client::cursor(),
   ]);
});

Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::singleton('profile', ProfileController::class)->destroyable();

Route::post('/notifications/mark-read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return response()->json(['status' => 'read']);
})->middleware(['auth'])->name('notifications.markRead');

require __DIR__ . '/auth.php';
require __DIR__ . '/client.php';
require __DIR__ . '/freelancer.php';
