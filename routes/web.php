<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CoinController;

Route::middleware(['auth'])->group(function () {
    Route::get('/coins', [CoinController::class, 'index'])->name('coins.index');
    Route::get('/coins/create', [CoinController::class, 'create'])->name('coins.create');
    Route::post('/coins', [CoinController::class, 'store'])->name('coins.store');
});

Route::get('/coins/create', [CoinController::class, 'create'])->name('coins.create');
Route::post('/coins/store', [CoinController::class, 'store'])->name('coins.store');
Route::post('/coins/purchase', [CoinController::class, 'purchaseCoins'])->name('coins.purchase');
Route::get('/coins', [CoinController::class, 'showCoinsPage'])->name('coins.show');


Route::middleware(['auth'])->group(function () {
    Route::post('/carts/add/{imageId}', [CartController::class, 'add'])->name('carts.add');
    Route::get('/carts', [CartController::class, 'show'])->name('cart.show');
    Route::delete('/carts/{id}', [CartController::class, 'destroy'])->name('carts.destroy');
});



Route::middleware(['auth'])->group(function () {
    Route::post('/favorites/{imageId}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{imageId}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index'); // Route นี้จะชี้ไปยังหน้า My Favorite
});

Route::get('/images/create', action: [ImageController::class, 'create'])->middleware('auth'); // แสดงฟอร์ม
Route::get('/images', action: [ImageController::class, 'index']);
Route::post('/images', [ImageController::class, 'store'])->middleware('auth'); // อัปโหลดภาพ
Route::get('/images', [ImageController::class, 'index'])->name('images.index')->middleware('auth'); // แสดงภาพทั้งหมด
Route::get('/images/upload', [ImageController::class, 'create'])->name('images.create')->middleware('auth');
Route::post('/images', [ImageController::class, 'store'])->name('images.store')->middleware('auth');
Route::get('/images/{id}', [ImageController::class, 'show'])->name('images.show');

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

require __DIR__ . '/auth.php';
//