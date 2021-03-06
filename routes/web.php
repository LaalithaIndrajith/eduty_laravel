<?php

use App\Client;
use App\Events\newCustomerCreated;
use App\Events\userDetailsUpdatedEvent;
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
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskFlowController;
use App\Mail\customerRegistered;
use App\Mail\userEdited;
use App\User;

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

// Users
Route::get('/viewRegisterUser',[RegisterController::class, 'index'])->name('userRegisterView');
Route::get('/viewUser/{id}/edit',[UserController::class, 'viewUserForEdit'])->name('userEditView');
Route::post('/register',[RegisterController::class, 'registerUsers'])->name('userRegister');
Route::post('/User/{id}/edit',[RegisterController::class, 'editUser'])->name('editUser');
Route::get('/viewUserList',[UserController::class, 'index'])->name('viewUserList');
Route::post('/fecthUsersToDrawTbl',[UserController::class, 'fecthUsersToDrawTbl'])->name('fecthUsersToDrawTbl');
Route::post('/fetchDesignationsOfDep',[DesignationController::class, 'fetchDesignationsOfDep'])->name('fetchDesignationsOfDep');

// TaskFlows
Route::get('/viewCreateTaskFlow',[TaskFlowController::class, 'index'])->name('taskflowCreationView');
Route::post('/Taskflow/Create',[TaskFlowController::class, 'createTaskFlow'])->name('createTaskFlow');
Route::get('/viewTaskFlow/{id}/edit',[TaskFlowController::class, 'viewTaskFlowForEdit'])->name('taskflowEditView');
Route::post('/Taskflow/edit',[TaskFlowController::class, 'editTaskFlow'])->name('editTaskFlow');
Route::post('/Task/edit',[TaskFlowController::class, 'editTask'])->name('editTask');
Route::post('/Task/delete',[TaskFlowController::class, 'deleteTask'])->name('deleteTask');
Route::post('/Taskflow/delete',[TaskFlowController::class, 'deleteTaskFlow'])->name('deleteTaskFlow');
Route::get('/viewTaskFlowList',[TaskFlowController::class, 'viewTaskFlowList'])->name('viewTaskFlowList');
Route::post('/fecthTaskFlowsToDrawTbl',[TaskFlowController::class, 'fecthTaskFlowsToDrawTbl'])->name('fecthTaskFlowsToDrawTbl');
Route::post('/fetchTasksOfTaskFlow',[TaskFlowController::class, 'fetchTasksOfTaskFlow'])->name('fetchTasksOfTaskFlow');
Route::post('/fetchTaskDetailsOfTask',[TaskFlowController::class, 'fetchTaskDetailsOfTask'])->name('fetchTaskDetailsOfTask');
Route::post('/getNewStepNum',[TaskFlowController::class, 'getNewStepNum'])->name('getNewStepNum');
Route::post('/addNewTask',[TaskFlowController::class, 'addNewTask'])->name('addNewTask');

//Clients
Route::get('/viewRegisterClient',[ClientController::class, 'index'])->name('clientRegisterView');
Route::get('/viewClientList',[ClientController::class, 'viewClientList'])->name('viewClientList');
Route::get('/viewClient/{id}/edit',[ClientController::class, 'viewClientForEdit'])->name('clientEditView');
Route::post('/Client/Register',[ClientController::class, 'registerClient'])->name('clientRegister');
Route::post('/Client/{id}/edit',[ClientController::class, 'editClient'])->name('editClient');
Route::post('/Client/delete',[ClientController::class, 'deleteClient'])->name('deleteClient');
Route::post('/fetchClientsToDrawTbl',[ClientController::class, 'fetchClientsToDrawTbl'])->name('fetchClientsToDrawTbl');

//Jobs
Route::get('/viewCreateJobTicket',[JobController::class, 'index'])->name('jobTicketCreationView');
Route::get('/viewJobTicketList',[JobController::class, 'viewJobTicketList'])->name('viewJobTicketList');
Route::get('/viewAllocatedJobList',[JobController::class, 'viewAllocatedJobList'])->name('viewAllocatedJobList');
Route::get('/allocatedJob/{id}/edit',[JobController::class, 'viewAllocatedJobForEdit'])->name('allocatedJobEditView');
Route::post('/JobTicket/Create',[JobController::class, 'issueJobTicket'])->name('issueJobTicket');
Route::post('/getCustomerDetails',[JobController::class, 'getCustomerDetails'])->name('getCustomerDetails');
Route::post('/getTaskflowDetails',[JobController::class, 'getTaskflowDetails'])->name('getTaskflowDetails');
Route::post('/fetchJobTicketsToDrawTbl',[JobController::class, 'fetchJobTicketsToDrawTbl'])->name('fetchJobTicketsToDrawTbl');
Route::post('/fetchAllocatedJobsToDrawTbl',[JobController::class, 'fetchAllocatedJobsToDrawTbl'])->name('fetchAllocatedJobsToDrawTbl');
Route::post('/fetchJobTicketDetails',[JobController::class, 'fetchJobTicketDetails'])->name('fetchJobTicketDetails');
Route::post('/takeTask',[JobController::class, 'takeTask'])->name('takeTask');
Route::post('/completeTask',[JobController::class, 'completeTask'])->name('completeTask');
Route::post('/rejectTask',[JobController::class, 'rejectTask'])->name('rejectTask');

/**
 * Dashboard
 */

 //System Admin
Route::post('/getSysAdminDashDetails',[DashboardController::class, 'getSysAdminDashDetails'])->name('getSysAdminDashDetails');
Route::post('/getSysAdminDoughnutChartData',[DashboardController::class, 'getSysAdminDoughnutChartData'])->name('getSysAdminDoughnutChartData');

//Department Admin
Route::post('/getDepAdminDashDetails',[DashboardController::class, 'getDepAdminDashDetails'])->name('getDepAdminDashDetails');
Route::post('/getDepAdminDoughnutChartData',[DashboardController::class, 'getDepAdminDoughnutChartData'])->name('getDepAdminDoughnutChartData');

//Normal User
Route::post('/getNormalDashDetails',[DashboardController::class, 'getNormalDashDetails'])->name('getNormalDashDetails');

//Front Desk
Route::post('/getFrontDeskDashDetails',[DashboardController::class, 'getFrontDeskDashDetails'])->name('getFrontDeskDashDetails');

//Reports
Route::get('/viewMonthlyOverAllReport',[ReportController::class, 'viewMonthlyOverAllReport'])->name('monthlyOverAllReport');
Route::get('/viewMonthlyDepOverViewReport',[ReportController::class, 'viewMonthlyDepOverViewReport'])->name('MonthlyDepOverViewReport');
Route::post('/getMonthlyOverviewJobTickets',[ReportController::class, 'getMonthlyOverviewJobTickets'])->name('getMonthlyOverviewJobTickets');
Route::post('/getMonthlyOverviewDepartment',[ReportController::class, 'getMonthlyOverviewDepartment'])->name('getMonthlyOverviewDepartment');


Route::get('/mailable', function () {
    $customer = Client::find(1);

    return new customerRegistered($customer);
});