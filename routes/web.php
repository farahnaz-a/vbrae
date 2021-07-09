<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\DigitalController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\SalesController;

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

// FrontendController 
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/add/listing', [FrontendController::class, 'addListing'])->name('frontend.addListing');
Route::get('/search', [FrontendController::class, 'search'])->name('game.search');
Route::get('/all/listing', [FrontendController::class, 'listing'])->name('frontend.listing');
Route::get('/filter/listing/{id}', [FrontendController::class, 'filterlisting'])->name('frontend.filterlisting');
Route::get('/region/listing/{region}', [FrontendController::class, 'regionlisting'])->name('frontend.regionlisting');
Route::get('/price/listing/{price}', [FrontendController::class, 'pricelisting'])->name('frontend.pricelisting');
Route::get('/listing/form/{id}', [FrontendController::class, 'listingForm'])->name('frontend.listingForm');
Route::get('/listing/{id}/details', [FrontendController::class, 'listingDetails'])->name('frontend.listingDetails');
Route::get('/game/{id}/overview', [FrontendController::class, 'overview'])->name('frontend.overview');
Route::get('/game', [FrontendController::class, 'game'])->name('frontend.game');


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

    // ListingController 
    Route::get('/listings', [ListingController::class, 'index'])->name('listings.index');
    Route::post('/listing/store', [ListingController::class, 'store'])->name('listings.store');

   // SalesController 
   Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');


// END Admin Route Group   
});