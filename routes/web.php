<?php

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

/*================================== Authentication ==================================*/
Auth::routes(['register' => false]);

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {


    /*================================== Dashboard ==================================*/
    Route::get('dashboard', 'HomeController@index')->name('admin.dashboard');
    Route::get('Profile', 'HomeController@Profile')->name('admin.profile');
    Route::get('historyGenerator', 'HomeController@historyGenerator')->name('admin.historyGenerator');
    Route::get('generateHistory', 'HomeController@generateHistory')->name('admin.generateHistory');


    /*================================== Change Password ==================================*/
    Route::get('changePassword', 'ChangePasswordController@index')->name('admin.changepassword');
    Route::post('change-password', 'ChangePasswordController@store')->name('change.password');


    /*================================== User Controller ==================================*/
    Route::resource('userManagement', 'UserController');


    /*================================== Expense Controller ==================================*/
    Route::resource('expense', 'ExpenseController');
    Route::get('showExpenseDetails/{Branch_id}', 'ExpenseController@showExpenseDetails');


    /*================================== Expense Controller ==================================*/
    Route::resource('personal_expense', 'PersonalExpenseController');


    /*================================== Account Controller ==================================*/
    Route::resource('account', 'AccountController');
    Route::get('Bank_Statement', 'AccountController@bankStatement')->name('account.bank_statement');
    Route::resource('BankManagement', 'BankDetailsController');


    /*================================== Employee Controller ==================================*/
    Route::resource('employeeManagement', 'EmployeeController');


    /*================================== Employee Controller ==================================*/
    Route::resource('assetManagement', 'AssetManagementController');


    /*================================== Supplier Controller ==================================*/
    Route::resource('SupplierManagement', 'SupplierManagementController');
    Route::resource('SupplierMetarialDetails', 'SupplierMetarialDetailsController');


    /*================================== Employee Salary Controller ==================================*/
    Route::resource('SalaryManagement', 'SalaryManagementController');
    Route::get('showSalaryDetails/{employee_id}', 'SalaryManagementController@showSalaryDetails');


    /*================================== Project Details Controller ==================================*/
    Route::resource('projectDetails', 'ProjectDetailsController');
    Route::resource('projectPartner', 'ProjectPartnerController');
    Route::resource('projectCost', 'ProjectCostController');
    Route::get('showCostDateWise/{date}/{project_id}', 'ProjectCostController@showCostDateWise');


    /*================================== Project Invest Amount Controller ==================================*/
    Route::resource('projectInvestAmount','ProjectInvestAmountController');

    /*================================== Branch Controller ==================================*/
    Route::resource('branchManagement','BranchController');

});


View::composer('*', function ($view) {
    date_default_timezone_set("Asia/Dhaka");
});
