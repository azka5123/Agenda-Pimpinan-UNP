<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Front\FrontHomeController;
use App\Http\Controllers\User\UserLoginController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//admin
Route::get('/admin/dashboard', [AdminLoginController::class, 'index'])->name('admin_dashboard')->middleware('admin:admin');
Route::get('/admin/login', [AdminLoginController::class, 'login'])->name('admin_login');
Route::post('/admin/login-submit', [AdminLoginController::class, 'login_submit'])->name('admin_login_submit');
Route::get('/admin/forget-password', [AdminLoginController::class, 'forget_pass'])->name('admin_forget_password');
Route::post('/admin/forget-submit', [AdminLoginController::class, 'forget_submit'])->name('admin_forget_submit');
Route::get('/admin/reset-password/{token}/{email}', [AdminLoginController::class, 'reset_password'])->name('admin_reset_password');
Route::post('/admin/reset-submit', [AdminLoginController::class, 'reset_submit'])->name('admin_reset_submit');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');
//end admin

// admin user
Route::get('/admin/user/show', [AdminUserController::class, 'show'])->name('admin_user_show')->middleware('admin:admin');
Route::get('/admin/user/create', [AdminUserController::class, 'create'])->name('admin_user_create')->middleware('admin:admin');
Route::post('/admin/user/store', [AdminUserController::class, 'store'])->name('admin_user_store')->middleware('admin:admin');
Route::get('/admin/user/edit/{id}', [AdminUserController::class, 'edit'])->name('admin_user_edit')->middleware('admin:admin');
Route::post('/admin/user/update/{id}', [AdminUserController::class, 'update'])->name('admin_user_update')->middleware('admin:admin');
Route::get('/admin/user/delete/{id}', [AdminUserController::class, 'delete'])->name('admin_user_delete')->middleware('admin:admin');
// end admin user

//user login
Route::get('user/login',[UserLoginController::class,'login'])->name('user_login');
Route::post('user/login-submit', [UserLoginController::class, 'login_submit'])->name('user_login_submit');
Route::get('user/forget-password', [UserLoginController::class, 'forget_pass'])->name('user_forget_password');
Route::post('user/forget-submit', [UserLoginController::class, 'forget_submit'])->name('user_forget_submit');
Route::get('user/reset-password/{token}/{email}', [UserLoginController::class, 'reset_password'])->name('user_reset_password');
Route::post('user/reset-submit', [UserLoginController::class, 'reset_submit'])->name('user_reset_submit');
Route::get('user/logout', [UserLoginController::class, 'logout'])->name('user_logout');
//user login end

//front
Route::get('/', [FrontHomeController::class, 'show'])->name('front_show');
Route::get('/search', [FrontHomeController::class, 'search'])->name('front_search');
Route::get('/{id}/{nama}', [FrontHomeController::class, 'show2'])->name('front_show2');
//end front