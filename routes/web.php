<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DigitalController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PlatformController;

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

Route::get('/', function () {
    return view('welcome');
});

// AdminController 
Route::group(['prefix' => 'admin'], function () {

    // AdminController 
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/create', [AdminController::class, 'create'])->name('create.admin');

    // GameController
    Route::get('/games', [GameController::class, 'index'])->name('games.index');

    // GenreController 
    Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');

    // PlatformController 
    Route::get('/platforms', [PlatformController::class, 'index'])->name('platforms.index');
    Route::get('/digitals', [DigitalController::class, 'index'])->name('digitals.index');
});