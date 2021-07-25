<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommunityIconController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\DigitalController;
use App\Http\Controllers\FooterBuyController;
use App\Http\Controllers\FooterFirstRowController;
use App\Http\Controllers\FooterMenuController;
use App\Http\Controllers\FooterResourceController;
use App\Http\Controllers\FooterSellController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GamingConsoleController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentGatewayController;

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
Route::get('/listing/edit-form/{id}', [FrontendController::class, 'listingEditForm'])->name('frontend.listingEditForm');
Route::get('/listing/{id}/details', [FrontendController::class, 'listingDetails'])->name('frontend.listingDetails');
Route::get('/game/{id}/overview', [FrontendController::class, 'overview'])->name('frontend.overview');
Route::get('/game', [FrontendController::class, 'game'])->name('frontend.game');
Route::get('/wishlists', [WishListController::class, 'index'])->name('wishlist.index');
Route::get('/wishlist/{id}/delete', [WishListController::class, 'delete'])->name('wishlist.delete');
Route::post('/wishlist-store', [WishListController::class, 'store'])->name('wishlist.store');
Route::get('/notification/{id}/seen', [NotificationController::class, 'seen'])->name('notification.seen');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notification.index');
Route::get('/user-profile/{id}/{name}', [FrontendController::class, 'userprofile'])->name('frontend.userprofile');
Route::get('/buy/{id}', [FrontendController::class, 'buy'])->middleware('auth')->name('frontend.buy');
Route::post('/checkout', [FrontendController::class, 'checkout'])->name('frontend.checkout');
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

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
    Route::post('/listing/update', [ListingController::class, 'update'])->name('listings.update');
    Route::get('/listing/{id}/delete', [ListingController::class, 'delete'])->name('listings.delete');

   // SalesController 
   Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');

   // GamingController 
   Route::resource('gamingconsoles', GamingConsoleController::class);
   // FooterFirstRowController 
   Route::resource('footerFirstRows', FooterFirstRowController::class);
   // FooterSellController 
   Route::resource('footerSells', FooterSellController::class);
   // FooterBuyController 
   Route::resource('footerBuys', FooterBuyController::class);
   // FooterResourceController 
   Route::resource('footerResources', FooterResourceController::class);
   // CommuintyIconController 
   Route::resource('communityIcons', CommunityIconController::class);
   // FooterMenuController 
   Route::resource('footerMenus', FooterMenuController::class);
   // PaymentgatewayController 
   Route::resource('paymentGateways', PaymentGatewayController::class);



// END Admin Route Group   
});

// User Dashboard Route Group 
Route::group(['prefix' => 'users'], function () {
    // UserController 
    Route::get('/dashboard/{name}', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/{id}/settings', [UserController::class, 'settings'])->name('user.settings');
    Route::post('/{id}/update', [UserController::class, 'update'])->name('user.update');
});