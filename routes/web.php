<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\DashBoardController::class, 'show'])->middleware(['auth', 'verified'])->name("dashboard");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [\App\Http\Controllers\FriendController::class, 'getUsers'])->name('users');
    Route::get('/users/{user}', [\App\Http\Controllers\FriendController::class, 'getUserData'])->name('users.data');
    Route::post('/users/search', [\App\Http\Controllers\FriendController::class, 'searchUsers'])->name("users.search");
    Route::post('/users/friend/{user}', [\App\Http\Controllers\FriendController::class, 'createFriends'])->name("users.create.friend");
    Route::post('friend/accept/{user}', [\App\Http\Controllers\FriendController::class, 'acceptFriend'])->name("friend.accept");
    Route::post('friend/deny/{user}', [\App\Http\Controllers\FriendController::class, 'denyFriend'])->name("friend.deny");
});

require __DIR__.'/auth.php';
