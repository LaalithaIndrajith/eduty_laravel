<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;

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
Route::get('/viewRegisterUser',[RegisterController::class, 'index'])->name('userRegisterView');
Route::post('/register',[RegisterController::class, 'registerUsers'])->name('userRegister');
Route::get('/viewUserList',[UserController::class, 'index'])->name('viewUserList');
Route::post('/fecthUsersToDrawTbl',[UserController::class, 'fecthUsersToDrawTbl'])->name('fecthUsersToDrawTbl');

/*
|--------------------------------------------------------------------------
| Routes belongs to Configuration Modules
|--------------------------------------------------------------------------
*/
// Access Permissions
Route::get('/viewUserType',[UserTypeController::class, 'index'])->name('userTypeCreationView');
Route::post('/createUserType',[UserTypeController::class, 'createUserType'])->name('createUserType');
Route::post('/fetchUserTypesToDrawTbl',[UserTypeController::class, 'fetchUserTypesToDrawTbl'])->name('fetchUserTypesToDrawTbl');

Route::get('/viewPermission',[PermissionController::class, 'index'])->name('PermissionCreationView');
Route::post('/createPermission',[PermissionController::class, 'createPermission'])->name('createPermission');
Route::post('/fetchPermissionsToDrawTbl',[PermissionController::class, 'fetchPermissionsToDrawTbl'])->name('fetchPermissionsToDrawTbl');
