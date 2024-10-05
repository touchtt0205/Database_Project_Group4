<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\SlipController;
use App\Http\Controllers\AdminCoinController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminOrderHistoryController;

Route::get('/admin/oder-history', [AdminOrderHistoryController::class, 'index'])->name('admin.orderHistory.index');
Route::get('/admin/order-history/user/{userId}', [AdminOrderHistoryController::class, 'showUserOrderHistory'])->name('admin.order.history.user');

Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');

Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/slips', [AdminCoinController::class, 'index'])->name('admin.slips.index');
    Route::post('/slips/{id}/approve', [AdminCoinController::class, 'approveSlip'])->name('admin.slips.approve');
    Route::post('/slips/{id}/reject', [AdminCoinController::class, 'rejectSlip'])->name('admin.slips.reject');
});

Route::post('/slips', [SlipController::class, 'store'])->name('slips.store');
Route::get('/coins', [CoinController::class, 'showCoinPackages'])->name('coins.index');
Route::post('/coins', [CoinController::class, 'store'])->name('coins.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.show');
    Route::post('/carts/add/{imageId}', [CartController::class, 'add'])->name('carts.add');
    Route::get('/carts', [CartController::class, 'show'])->name('cart.show');
    Route::delete('/carts/{id}', [CartController::class, 'destroy'])->name('carts.destroy');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
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
Route::post('/images/{image}/purchase', [ImageController::class, 'purchase'])->name('images.purchase');
Route::get('/images/download/{id}', [ImageController::class, 'download'])->name('images.download');
Route::post('/images/buy/{id}', [ImageController::class, 'buy'])->name('images.buy');

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