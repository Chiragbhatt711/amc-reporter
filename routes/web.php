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
    Route::post('/add-group','GroupController@create')->name('add_group');
    Route::post('/add-brand','BrandController@create')->name('add_brand');
    Route::post('/add-model','ContractModelController@create')->name('add_model');
    Route::post('/product-add','ManageAmcController@product_add')->name('product_add');
    Route::post('/get-tex','ManageTaxController@getTex')->name('get_tex');
    Route::get('/amc-expiry-reminder','AmcExpiryReminderController@index')->name('amc_expiry_reminder');
    Route::get('/amc-renew/{id}','AmcExpiryReminderController@amcRenew')->name('amc_renew');
    Route::patch('/amc-renew/{id}','AmcExpiryReminderController@amcRenewUpdate')->name('amc_renew_update');

    Route::post('/get-amc-number','ManageReceiptController@getAmcNumber')->name('get_amc_number');
    Route::post('/get-due-amount','ManageReceiptController@getDueAmount')->name('get_due_amount');
    Route::post('/get-amc-party','ManageComplaintController@amcParty')->name('get_amc_party');
    Route::get('/call-update/{id}','ManageComplaintController@callUpdate')->name('call_update');
    Route::PATCH('/call-update/{id}','ManageComplaintController@callUpdatePost')->name('call_update_post');
    Route::post('/item-add','ManageComplaintController@itemAdd')->name('item_add');
    Route::get('/call-register','ManageComplaintController@callRegister')->name('call_register');
    Route::get('/complaint-summary','ManageComplaintController@complaintSummary')->name('complaint_summary');
    Route::get('/party-ledger-summary','ManageAmcController@partyLedgerSummary')->name('party_ledger_summary');
    Route::get('/party-ledger-details','ManageAmcController@partyLedgerDetail')->name('party_ledger_details');
    Route::post('/get-product-detail','ManageInwardController@getProductDetail')->name('get_product_detail');
    Route::post('/add-product','ManageInwardController@addProduct')->name('add_product');
    Route::post('/get-outward-product-detail','ManageOutwardController@getProductDetail')->name('get_product_detail_outward');
    Route::get('/stock-register','StockManagmentController@stockRegister')->name('stock_register');
    Route::get('/month-wise-item-stock','StockManagmentController@MonthWiseItemStock')->name('month_wise_item_stock');
    Route::get('/minimum-item-stock-report','StockManagmentController@minimumItemStockReport')->name('minimum_item_stock_report');

    Route::get('/call-dashboard','HomeController@callDashboard')->name('call_dashboard');
    Route::get('/stock-dashboard','HomeController@stockDashboard')->name('stock_dashboard');

    Route::post('/amc-product-detail','ManageAmcController@AmcProductDetails')->name('amc_product_detail');

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
    Route::resource('payment_pending_report',PaymentPendingReportController::class);
    Route::resource('manage_executive',ExecutiveController::class);
    Route::resource('service_tax_report',ServiceTaxReportController::class);
    Route::resource('manage_complaint',ManageComplaintController::class);
    Route::resource('product_group',ProductGroupController::class);
    Route::resource('manage_product',ManageProductController::class);
    Route::resource('manage_supplier',SupplierController::class);
    Route::resource('manage_inward',ManageInwardController::class);
    Route::resource('manage_outward',ManageOutwardController::class);

});
