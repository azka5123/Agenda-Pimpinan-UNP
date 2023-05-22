<?php

use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Front\FrontHomeController;
use App\Http\Controllers\User\UserJadwalController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Mail\EmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

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
Route::get('/admin/login', [AdminLoginController::class, 'login'])->name('admin_login');
Route::post('/admin/login-submit', [AdminLoginController::class, 'login_submit'])->name('admin_login_submit');
Route::get('/admin/forget-password', [AdminLoginController::class, 'forget_pass'])->name('admin_forget_password');
Route::post('/admin/forget-submit', [AdminLoginController::class, 'forget_submit'])->name('admin_forget_submit');
Route::get('/admin/reset-password/{token}/{email}', [AdminLoginController::class, 'reset_password'])->name('admin_reset_password');
Route::post('/admin/reset-submit', [AdminLoginController::class, 'reset_submit'])->name('admin_reset_submit');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout')->middleware('admin:admin');
//end admin

// admin user
Route::middleware('admin:admin')->group(function () {
    Route::get('/admin/user/show', [AdminUserController::class, 'show'])->name('admin_user_show');
    Route::get('/admin/user/create', [AdminUserController::class, 'create'])->name('admin_user_create');
    Route::post('/admin/user/store', [AdminUserController::class, 'store'])->name('admin_user_store');
    Route::get('/admin/user/edit/{id}', [AdminUserController::class, 'edit'])->name('admin_user_edit');
    Route::post('/admin/user/update/{id}', [AdminUserController::class, 'update'])->name('admin_user_update');
    Route::get('/admin/user/delete/{id}', [AdminUserController::class, 'delete'])->name('admin_user_delete');
    Route::get('/admin/user/rekap/{id}', [AdminUserController::class, 'rekap'])->name('admin_user_rekap');
    Route::get('/admin/user/rekap/export/{id}', [AdminUserController::class, 'export'])->name('admin_user_export');
});

// end admin user

//user login
Route::post('user/login-submit', [UserLoginController::class, 'login_submit'])->name('user_login_submit');
Route::get('/user/dashboard', [UserLoginController::class, 'index'])->name('user_dashboard');
Route::get('user/forget-password', [UserLoginController::class, 'forget_pass'])->name('user_forget_password');
Route::post('user/forget-submit', [UserLoginController::class, 'forget_submit'])->name('user_forget_submit');
Route::get('user/reset-password/{token}/{email}', [UserLoginController::class, 'reset_password'])->name('user_reset_password');
Route::post('user/reset-submit', [UserLoginController::class, 'reset_submit'])->name('user_reset_submit');
Route::get('user/logout', [UserLoginController::class, 'logout'])->name('user_logout')->middleware('auth');
//user login end

//user jadwal
Route::middleware(['auth'])->group(function () {
    Route::get('/user/notif', [UserJadwalController::class, 'markAsRead'])->name('notif_jadwal');
    Route::get('/user/unread', [UserJadwalController::class, 'unread'])->name('unread');
    Route::get('/user/show/jadwal', [UserJadwalController::class, 'show'])->name('show_jadwal');
    Route::get('/user/show/all_jadwal', [UserJadwalController::class, 'show2'])->name('show_all_jadwal');
    Route::get('/user/create/jadwal', [UserJadwalController::class, 'create'])->name('create_jadwal');
    Route::post('/user/store', [UserJadwalController::class, 'store'])->name('store_jadwal');
    Route::get('/user/edit/jadwal/{id}', [UserJadwalController::class, 'edit'])->name('edit_jadwal');
    Route::post('/user/update/jadwal/{id}', [UserJadwalController::class, 'update'])->name('update_jadwal');
    Route::get('/user/delete/jadwal/{id}', [UserJadwalController::class, 'delete'])->name('delete_jadwal');
});


//front
Route::get('/', [FrontHomeController::class, 'show'])->name('front_show');
Route::get('/search', [FrontHomeController::class, 'search'])->name('front_search');
Route::get('/search/{nama}', [FrontHomeController::class, 'show2'])->name('front_show2');
Route::get('/reload/{nama}', [FrontHomeController::class, 'reload'])->name('front_reload');
//end front