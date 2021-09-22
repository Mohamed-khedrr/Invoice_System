<?php

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

Route::get('/', function () {
    return view('index');
})->middleware('auth');



Route::get('/home', 'HomeController@index')->name('home');
Route::resource('sections', SectionController::class);
Route::resource('invoices', InvoiceController::class);
Route::resource('products', ProductController::class);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{page}', 'AdminController@index');
