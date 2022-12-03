<?php

use App\Http\Controllers\Auth\LoginController;
use App\Models\Role;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::resource('login',Auth\LoginController::class);
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/register','Auth\RegisterController@index')->name('register');
Route::post('/register','Auth\RegisterController@store')->name('register_post');

Route::group(['middleware' => ['auth']], function() {

    Route::get('/logout','Auth\LoginController@logout')->name('logout');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/add-group','GroupController@create');
    Route::post('/add-brand','BrandController@create');
    Route::post('/add-model','ContractModelController@create');
    Route::post('/product-add','ManageAmcController@product_add');
    Route::post('/get-tex','ManageTaxController@getTex');
    Route::get('/amc-expiry-reminder','AmcExpiryReminderController@index')->name('amc_expiry_reminder');
    Route::get('/amc-renew/{id}','AmcExpiryReminderController@amcRenew')->name('amc_renew');

    Route::post('/get-amc-number','ManageReceiptController@getAmcNumber')->name('get_amc_number');
    Route::post('/get-due-amount','ManageReceiptController@getDueAmount')->name('get_due_amount');

    Route::resource('amc', AmcController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('contract_type', ContractTypeController::class);
    Route::resource('manage_party', ManagePartyController::class);
    Route::resource('manage_amc', ManageAmcController::class);
    Route::resource('manage_tax', ManageTaxController::class);
    Route::resource('manage_receipt',ManageReceiptController::class);
    Route::resource('manage_complaint_template',ManageComplaintTemplateController::class);
    Route::resource('manage_solution_template',ManageSolutionTemplateController::class);

});
