<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminAuctionController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WatchlistController;

  Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('users', UserController::class);
});



// Admin routes group (protected by auth and admin middleware)
Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
     Route::resource('orders', OrderController::class);
     Route::resource('discounts', DiscountController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});




require __DIR__.'/auth.php';


Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/catalog/{product}', [CatalogController::class, 'show'])->name('catalog.show');


Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
   Route::get('/cart-count', [CartController::class, 'count'])->name('cart.count');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
});
Route::middleware('auth')->group(function () {
    Route::get('/orders', [UserOrderController::class, 'index'])->name('user.orders.index');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('user.orders.show');
});
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});

// Public Auction Routes (require auth for create/store, but index/show are public)

Route::middleware('auth')->group(function () {
    Route::get('/auctions', [AuctionController::class, 'index'])->name('auctions.index');
    Route::get('/auctions/create', [AuctionController::class, 'create'])->name('auctions.create');
    Route::post('/auctions', [AuctionController::class, 'store'])->name('auctions.store');
    Route::get('/auctions/{auction}', [AuctionController::class, 'show'])->name('auctions.show');
});

Route::middleware('auth')->group(function () {
    Route::post('/auctions/{auction}/bids', [BidController::class, 'store'])->name('bids.store');
});





Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('users', UserController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::resource('products', ProductController::class);
});

// routes/web.php
Route::middleware('auth')->group(function () {
    Route::get('/watchlist', [WatchlistController::class, 'index'])->name('watchlist.index');
    Route::post('/watchlist', [WatchlistController::class, 'store'])->name('watchlist.add');
    Route::delete('/watchlist/{watchlist}', [WatchlistController::class, 'destroy'])->name('watchlist.remove');
});

Route::get('/auctions', [AuctionController::class, 'index'])->name('auctions.index');
Route::middleware(['auth'])->group(function () {
    Route::get('/auctions/create', [AuctionController::class, 'create'])->name('auctions.create');
    Route::post('/auctions', [AuctionController::class, 'store'])->name('auctions.store');
    Route::get('/auctions/{auction}', [AuctionController::class, 'show'])->name('auctions.show');
    Route::get('/auctions/{auction}/edit', [AuctionController::class, 'edit'])->name('auctions.edit');
    Route::put('/auctions/{auction}', [AuctionController::class, 'update'])->name('auctions.update');
    Route::delete('/auctions/{auction}', [AuctionController::class, 'destroy'])->name('auctions.destroy');
});

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // Existing routes...
    Route::resource('auctions', AdminAuctionController::class);
    Route::post('auctions/{auction}/cancel', [AdminAuctionController::class, 'cancel'])->name('auctions.cancel');
    Route::post('auctions/{auction}/close', [AdminAuctionController::class, 'close'])->name('auctions.close');
});


Route::get('/about', [PageController::class, 'about'])->name('about.index');
Route::get('/contact', [PageController::class, 'contact'])->name('contact.index');
Route::post('/contact', [PageController::class, 'store'])->name('contact.store');
// routes/web.php
Route::get('/auction/{auction}/pay', [AuctionController::class, 'payWinningBid'])
    ->name('auction.pay');
    Route::middleware('auth')->group(function () {
    Route::get('/my-auctions', [AuctionController::class, 'myAuctions'])->name('auctions.my');
});
