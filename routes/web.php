<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;

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

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

// Authentication routes
Route::get('/',[LoginController::class, 'index'])->name('loginView');
Route::post('/login',[LoginController::class, 'authenticateUser'])->name('login');
Route::post('/logout',[LogoutController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Routes belongs to Master Modules
|--------------------------------------------------------------------------
*/

// Users
Route::get('/register',[RegisterController::class, 'index'])->name('userRegisterView');
Route::post('/register',[RegisterController::class, 'registerUsers'])->name('userRegister');
Route::get('/userList',[UserController::class, 'index'])->name('userList');
Route::post('/fecthUsersToDrawTbl',[UserController::class, 'fecthUsersToDrawTbl'])->name('fecthUsersToDrawTbl');