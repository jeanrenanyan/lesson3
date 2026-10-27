<?php
namespace App\Http\Controllers;
use App\Http\Controllers\CastleController;

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

Route::get('/castles', [CastleController::class, 'index']);

Route::get('/castles/create', [CastleController::class, 'create']);

Route::post('/castles', [CastleController::class, 'store']);

Route::get('/castles/{castle}', [CastleController::class, 'show']);

Route::get('/castles/{castle}/edit', [CastleController::class, 'edit']);

Route::put('/castles/{castle}/edit', [CastleController::class, 'update']);

Route::delete('/castles/{castle}', [CastleController::class, 'destroy']);



