<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberAuthController;

use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

use App\Http\Controllers\UserPageController;

use App\Http\Controllers\MemberPageController;  
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;

use App\Http\Controllers\MemberPasswordController;
use App\Http\Controllers\MemberProfileController;

use Illuminate\Support\Facades\Auth;

Route::prefix('member')->middleware('auth:member')->group(function () {
    // 🏠 Member Pages
    Route::get('/home', [MemberPageController::class, 'home'])->name('member.home');
    Route::get('/menu', [MemberPageController::class, 'menu'])->name('member.menu');
    Route::get('/promotion', [MemberPageController::class, 'promotion'])->name('member.promotion');
    Route::get('/contact', [MemberPageController::class, 'contact'])->name('member.contact');

    // 📌 รายละเอียดเมนู
    Route::get('/menu/{id}', [MemberPageController::class, 'menudetail'])->name('member.menudetail');

    // 📌 Member Info (Read-only)
    Route::get('/memberinfo', [MemberProfileController::class, 'memberinfo'])->name('member.memberinfo');

    // 📌 โปรไฟล์ (แก้ไข)
    Route::get('/profile', [MemberProfileController::class, 'profile'])->name('member.profile');
    Route::post('/profile/update', [MemberProfileController::class, 'updateProfile'])->name('member.profile.update');

    // 📌 เปลี่ยนรหัสผ่าน
    Route::get('/password', [MemberPasswordController::class, 'edit'])->name('member.password');
    Route::post('/password/update', [MemberPasswordController::class, 'update'])->name('member.password.update');

    // 📌 Avatar
    Route::post('/avatar/update', [MemberProfileController::class, 'updateAvatar'])->name('member.avatar.update');
    Route::delete('/avatar/delete', [MemberProfileController::class, 'deleteAvatar'])->name('member.avatar.delete');

    // 📌 เมนูโปรด
    Route::get('/favorites', [MemberProfileController::class, 'favorites'])->name('member.favorites');
    Route::post('/favorite', [FavoriteController::class, 'store'])->name('member.addFavorite');
    Route::delete('/favorites/{menu_id}', [MemberProfileController::class, 'removeFavorite'])->name('member.removeFavorite');

    // 📌 รีวิว
    Route::get('/menu/{menu_id}/reviews', [ReviewController::class, 'index'])->name('member.reviews');
    Route::post('/menu/{menu_id}/reviews', [ReviewController::class, 'store'])->name('member.review.store');

    // 📌 ลบบัญชี
    Route::post('/account/delete', [MemberProfileController::class, 'deleteAccount'])->name('member.account.delete');
});

 


// ==========================
// Auth ของ Member (อยู่นอก middleware)
// ==========================
Route::get('/member/register', [MemberAuthController::class, 'showRegisterForm'])->name('member.register');
Route::post('/member/register', [MemberAuthController::class, 'register'])->name('member.register.submit');
Route::get('/login', [MemberAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [MemberAuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [MemberAuthController::class, 'logout'])->name('logout');


// กลุ่มของ User
Route::prefix('user')->group(function () {
    Route::get('/home', [UserPageController::class, 'home'])->name('user.home');
    Route::get('/menu', [UserPageController::class, 'menu'])->name('user.menu');
    Route::get('/banner', [UserPageController::class, 'banner'])->name('user.banner');
    Route::get('/contact', [UserPageController::class, 'contact'])->name('user.contact');

    // ✅ menudetail
    Route::get('/menu/{id}', [UserPageController::class, 'menudetail'])->name('user.menudetail');
});

//home page
// ❌ เดิม: Route::get('/', [HomeController::class,'index']);
// ✅ แก้: ให้หน้าแรกไปที่ UserPageController@home
Route::get('/', [UserPageController::class, 'home'])->name('user.home');   // ⭐ ตรงนี้แก้ให้เรียก UserPageController

//authentication

//ทำไมต้องมี name('login') ?
//เวลาใช้ auth middleware ถ้า user ยังไม่ login → Laravel จะ redirect ไปหา route ที่ชื่อว่า login โดยอัตโนมัติ
//ถ้าไม่เจอ → มันก็โยน error Route [login] not defined.

//login เสร็จไปหน้า Dashboard
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

//employee crud
Route::get('/employee/searchfilter', [EmployeeController::class, 'searchfilter']);
Route::get('/employee', [EmployeeController::class, 'index']);
Route::get('/employee/adding',  [EmployeeController::class, 'adding']);
Route::post('/employee',  [EmployeeController::class, 'create']);
Route::get('/employee/{id}',  [EmployeeController::class, 'edit']);
Route::put('/employee/{id}',  [EmployeeController::class, 'update']);
Route::delete('/employee/remove/{id}',  [EmployeeController::class, 'remove']);
Route::get('/employee/reset/{id}',  [EmployeeController::class, 'reset']);
Route::put('/employee/reset/{id}',  [EmployeeController::class, 'resetPassword']);

//member crud
Route::get('/searchMember', [MemberController::class, 'searchMember']);
Route::get('/member', [MemberController::class, 'index']);
Route::get('/member/adding',  [MemberController::class, 'adding']);
Route::post('/member',  [MemberController::class, 'create']);
Route::get('/member/{id}',  [MemberController::class, 'edit']);
Route::put('/member/{id}',  [MemberController::class, 'update']);
Route::delete('/member/remove/{id}',  [MemberController::class, 'remove']);
Route::get('/member/reset/{id}',  [MemberController::class, 'reset']);
Route::put('/member/reset/{id}',  [MemberController::class, 'resetPassword']);

//menu crud
Route::get('menu/searchfilter', [MenuController::class, 'searchfilter']);
Route::get('/menu', [MenuController::class, 'index']);
Route::get('/menu/adding',  [MenuController::class, 'adding']);
Route::post('/menu',  [MenuController::class, 'create']);
Route::get('/menu/{id}',  [MenuController::class, 'edit']);
Route::put('/menu/{id}',  [MenuController::class, 'update']);
Route::delete('/menu/remove/{id}',  [MenuController::class, 'remove']);

//promotion crud
Route::get('/promotion', [PromotionController::class, 'index']);
Route::get('/promotion/adding',  [PromotionController::class, 'adding']);
Route::post('/promotion',  [PromotionController::class, 'create']);
Route::get('/promotion/{id}',  [PromotionController::class, 'edit']);
Route::put('/promotion/{id}',  [PromotionController::class, 'update']);
Route::delete('/promotion/remove/{id}',  [PromotionController::class, 'remove']);

//dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);
