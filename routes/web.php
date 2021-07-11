<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;

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
// Access & Permissions
Route::get('/viewUserType',[UserTypeController::class, 'index'])->name('userTypeCreationView');
Route::get('/viewUserType/{id}/edit',[UserTypeController::class, 'viewUserTypeForEdit'])->name('userTypeEditView');
Route::post('/UserType/Create',[UserTypeController::class, 'createUserType'])->name('createUserType');
Route::post('/UserType/{id}/edit',[UserTypeController::class, 'editUserType'])->name('editUserType');
Route::post('/fetchUserTypesToDrawTbl',[UserTypeController::class, 'fetchUserTypesToDrawTbl'])->name('fetchUserTypesToDrawTbl');

Route::get('/viewPermission',[PermissionController::class, 'index'])->name('PermissionCreationView');
Route::get('/viewPermission/{id}/edit',[PermissionController::class, 'viewPermissionForEdit'])->name('PermissionEditView');
Route::post('/Premission/Create',[PermissionController::class, 'createPermission'])->name('createPermission');
Route::post('/Premission/{id}/edit',[PermissionController::class, 'editPermission'])->name('editPermission');
Route::post('/fetchPermissionsToDrawTbl',[PermissionController::class, 'fetchPermissionsToDrawTbl'])->name('fetchPermissionsToDrawTbl');

Route::get('/viewAccessControl',[AccessController::class, 'index'])->name('AccessControlView');
Route::post('/grantPermission',[AccessController::class, 'grantPermission'])->name('grantPermission');
Route::post('/fetchRolesPermissionsToDrawTbl',[AccessController::class, 'fetchRolesPermissionsToDrawTbl'])->name('fetchRolesPermissionsToDrawTbl');
Route::post('/revokePermission',[AccessController::class, 'revokePermission'])->name('revokePermission');


/*
|--------------------------------------------------------------------------
| Routes belongs to Master Modules
|--------------------------------------------------------------------------
*/
// Departments
Route::get('/viewDepartment',[DepartmentController::class, 'index'])->name('departmentCreationView');
Route::get('/viewDepartment/{id}/edit',[DepartmentController::class, 'viewDepartmentForEdit'])->name('departmentEditView');
Route::post('/Department/Create',[DepartmentController::class, 'createDepartment'])->name('createDepartment');
Route::post('/Department/{id}/edit',[DepartmentController::class, 'editDepartment'])->name('editDepartment');
Route::get('/viewDepartmentList',[DepartmentController::class, 'viewDepartmentList'])->name('viewDepartmentList');
Route::post('/fetchDepartmentsToDrawTbl',[DepartmentController::class, 'fetchDepartmentsToDrawTbl'])->name('fetchDepartmentsToDrawTbl');

// Designations
Route::get('/viewDesignation',[DesignationController::class, 'index'])->name('designationCreationView');
Route::get('/viewDesignation/{id}/edit',[DesignationController::class, 'viewDesignationForEdit'])->name('designationEditView');
Route::post('/Designation/Create',[DesignationController::class, 'createDesignation'])->name('createDesignation');
Route::get('/viewDesignationList',[DesignationController::class, 'viewDesignationList'])->name('viewDesignationList');
Route::post('/Designation/{id}/edit',[DesignationController::class, 'editDesignation'])->name('editDesignation');
Route::post('/fetchDesignationsToDrawTbl',[DesignationController::class, 'fetchDesignationsToDrawTbl'])->name('fetchDesignationsToDrawTbl');
