<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;

Route::get('/products/my/{userId}', [ProductController::class, 'myProducts'])->name('products.my');
Route::get('/user/{userId}/products', [ProductController::class, 'showUserProducts'])->name('products.user');


Route::get('/', [ProductController::class, 'index'])->name('home');


Route::resource('products', ProductController::class);


Route::post('/favorites/{productId}', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle');
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');


Route::get('/order-summary', [OrderController::class, 'summary'])->name('order.summary');

// หน้าเพิ่มสินค้า
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


Route::middleware(['auth'])->group(function () {
    Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
    Route::post('/carts/{productId}', [CartController::class, 'store'])->name('carts.store');
    Route::delete('/carts/{id}', [CartController::class, 'destroy'])->name('carts.destroy');
    Route::patch('/carts/{cartId}', [CartController::class, 'update'])->name('carts.update');
    Route::post('/carts/checkout', [CartController::class, 'checkout'])->name('carts.checkout');
    Route::post('/carts/calculate', [CartController::class, 'calculate'])->name('carts.calculate');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
//