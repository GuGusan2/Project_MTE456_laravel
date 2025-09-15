<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PromotionController;

use App\Http\Controllers\DashboardController;

//home page
Route::get('/', [HomeController::class,'index']);

//employee crud
Route::get('/employee/searchfilter', [EmployeeController::class, 'searchfilter']);
Route::get('/employee/searchEmployee', [EmployeeController::class, 'searchEmployee']);
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
Route::get('menu/searchMenu', [MenuController::class, 'searchMenu']);
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