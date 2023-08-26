<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\backend\admin\DashboardController;
use App\Http\Controllers\backend\admin\UserController as AdminUserController;
use App\Http\Controllers\backend\user\CreditScoreController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Basic fuctionality of frontend 
Route::get('/',function(){
return view('welcome');
});

Route::get('/admin', [AuthController::class, 'admin_login_form'])->name('user_login_form');
Route::post('/login', [AuthController::class, 'admin_login'])->name('login');
Route::get('/register', [AuthController::class, 'sign_up_form'])->name('sign_up_form');
Route::post('/user-store', [UserController::class, 'user_store'])->name('user_store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// functionality for admin user
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('user', AdminUserController::class)->name('user','');

});
