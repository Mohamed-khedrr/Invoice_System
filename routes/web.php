<?php

use App\Invoice_details;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();
//Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->middleware('auth');




Route::get('/home', 'HomeController@index')->name('home');
Route::resource('sections', SectionController::class);
Route::resource('invoices', InvoiceController::class);
Route::resource('products', ProductController::class);
Route::resource('details', InvoiceDetailsController::class);

Route::post('unArchive', 'InvoiceController@unArchive');
Route::get('show_archive', 'InvoiceController@show_archive');
Route::post('archive', 'InvoiceController@archive');
Route::get('part_paid', 'InvoiceController@part_paid');
Route::get('unpaid_invoices', 'InvoiceController@unpaid');
Route::get('paid_invoices', 'InvoiceController@paid');
Route::get('/section/{id}', 'InvoiceController@getproducts');
Route::get('status_show/{invoice}', 'InvoiceController@status_show');
Route::get('update_status/{invoice}', 'InvoiceController@update_status')->name('update_status');


Route::get('/invoices_details/{id}', 'InvoiceDetailsController@index');

Route::get('view_file/{invoice_number}/{file_name}', 'InvoiceDetailsController@open_file');
Route::get('download_file/{invoice_number}/{file_name}', 'InvoiceDetailsController@download_file');




Route::get('mark_all', 'UserController@mark_all');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
});






Route::get('/{page}', 'AdminController@index');
