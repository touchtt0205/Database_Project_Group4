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
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PurchasedImagesController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\MemberSlipController;
use App\Http\Controllers\AdminMemberController;
use App\Http\Controllers\LikeController;


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/member', [AdminMemberController::class, 'index'])->name('admin.membership.index');
    Route::post('/member/{id}/approve', [AdminMemberController::class, 'approveSlip'])->name('admin.membership.approve');
    Route::post('/member/{id}/reject', [AdminMemberController::class, 'rejectSlip'])->name('admin.membership.reject');
});

Route::post('/membership/slips', [MemberSlipController::class, 'store'])->name('member.slips.store');


Route::middleware('auth')->group(function () {
    Route::get('/memberships', [MembershipController::class, 'showMembershipPackages'])->name('memberships.index');
    Route::post('/memberships/store', [MembershipController::class, 'store'])->name('memberships.store');
});



// Route สำหรับการจัดการสมาชิกใน admin
// Route::middleware(['auth', 'admin'])->group(function () { // Middleware เพื่อให้แน่ใจว่าเฉพาะผู้ดูแลระบบเข้าถึงได้
//     Route::get('/admin/memberships', [AdminMembershipController::class, 'index'])->name('admin.memberships.index');
//     Route::post('/admin/memberships/{id}/approve', [AdminMembershipController::class, 'approve'])->name('admin.memberships.approve');
//     Route::post('/admin/memberships/{id}/reject', [AdminMembershipController::class, 'reject'])->name('admin.memberships.reject');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/memberships', [MembershipController::class, 'index'])->name('memberships.index');
    Route::post('/memberships/purchase/{membership}', [MembershipController::class, 'purchase'])->name('memberships.purchase');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/slips/store', [MembershipController::class, 'storeSlip'])->name('slips.store');
});



// Route::prefix('admin')->middleware('auth')->group(function () {
//     Route::get('/memberships', [AdminMembershipController::class, 'index'])->name('admin.membership.index');
//     Route::post('/memberships/approve/{userId}', [AdminMembershipController::class, 'approveMembership'])->name('admin.membership.approve');
//     Route::post('/memberships/reject/{userId}', [AdminMembershipController::class, 'rejectMembership'])->name('admin.membership.reject');
// });

use App\Http\Controllers\AlbumController;

Route::get('/purchased-images', [PurchasedImagesController::class, 'index'])->name('purchased-images');


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
Route::delete('/images/{id}', [ImageController::class, 'destroy'])->name('images.destroy');
Route::get('/images/{id}', [ImageController::class, 'show'])->name('images.show');
Route::post('/images/{image}/purchase', [ImageController::class, 'purchase'])->name('images.purchase');
Route::get('/images/download/{id}', [ImageController::class, 'download'])->name('images.download');
Route::post('/images/buy/{id}', [ImageController::class, 'buy'])->name('images.buy');
Route::post('/images/{image}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('auth');
Route::get('/images', [ImageController::class, 'index'])->name('images.index');

Route::post('/images/{image}/like', [LikeController::class, 'like'])->name('images.like');
Route::delete('/images/{image}/unlike', [LikeController::class, 'unlike'])->name('images.unlike');

Route::get('/albums/create', [AlbumController::class, 'create'])->name('albums.create');
Route::resource('albums', AlbumController::class);
Route::post('/albums/{imageId}/add', [ImageController::class, 'addToAlbum'])->name('albums.add')->middleware('auth');
Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
Route::get('/albums/{album}', [AlbumController::class, 'show'])->name('albums.show');

Route::get('/', function () {
    return view('home'); // หน้าแรก
})->middleware('guest'); // เพิ่ม middleware ที่สร้าง



// Route::get('/', function () {
//     return view('home');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profileedit', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/edit/photo/update', [ProfileController::class, 'updateProfilePhoto'])->name('profile.photo.update');
    Route::get('/profile/{userId}', [ProfileController::class, 'showProfile'])->name('profile.show');
    
    
});



require __DIR__ . '/auth.php';
//