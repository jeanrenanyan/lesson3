<?php

use App\Http\Controllers\CastleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FriendshipController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/castles');

Route::get('/castles', [CastleController::class, 'index'])->name('castles.index');
Route::get('/users', [CastleController::class, 'users'])->name('users.index');
Route::get('/users/{user:username}/castles', [CastleController::class, 'userIndex'])
    ->name('users.castles');

Route::middleware('auth')->group(function () {
    Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');
    Route::post('/users/{user:username}/friends', [FriendshipController::class, 'store'])
        ->name('friends.store');
    Route::delete('/users/{user:username}/friends', [FriendshipController::class, 'destroy'])
        ->name('friends.destroy');

    Route::get('/castles/create', [CastleController::class, 'create'])->name('castles.create');
    Route::post('/castles', [CastleController::class, 'store'])->name('castles.store');
    Route::post('/castles/{castle}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::get('/castles/{castle}/edit', [CastleController::class, 'edit'])
        ->middleware('can:update-castle,castle')
        ->name('castles.edit');
    Route::put('/castles/{castle}/edit', [CastleController::class, 'update'])
        ->middleware('can:update-castle,castle')
        ->name('castles.update');
    Route::delete('/castles/{castle}', [CastleController::class, 'destroy'])
        ->middleware('can:delete-castle,castle')
        ->name('castles.destroy');

    Route::get('/admin/users/{user:username}/castles', [CastleController::class, 'userCastlesIncludingDeleted'])
        ->middleware('can:admin')
        ->name('admin.users.castles');
    Route::post('/admin/castles/{castle}/restore', [CastleController::class, 'restore'])
        ->middleware('can:admin')
        ->name('admin.castles.restore');
    Route::delete('/admin/castles/{castle}/force', [CastleController::class, 'forceDelete'])
        ->middleware('can:admin')
        ->name('admin.castles.force-delete');
});

Route::get('/castles/{castle}', [CastleController::class, 'show'])->name('castles.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

