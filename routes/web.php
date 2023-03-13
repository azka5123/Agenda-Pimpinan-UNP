<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminUserController;
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
//endadmin

// admin user
Route::get('/admin/user/show', [AdminUserController::class, 'show'])->name('admin_user_show')->middleware('admin:admin');
Route::get('/admin/user/create', [AdminUserController::class, 'create'])->name('admin_user_create')->middleware('admin:admin');
Route::post('/admin/user/store', [AdminUserController::class, 'store'])->name('admin_user_store')->middleware('admin:admin');
Route::get('/admin/user/edit/{id}', [AdminUserController::class, 'edit'])->name('admin_user_edit')->middleware('admin:admin');
Route::post('/admin/user/update/{id}', [AdminUserController::class, 'update'])->name('admin_user_update')->middleware('admin:admin');
Route::get('/admin/user/delete/{id}', [AdminUserController::class, 'delete'])->name('admin_user_delete')->middleware('admin:admin');
// end admin user