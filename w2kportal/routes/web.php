<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;

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
    return view('welcome');
});



// Group Routes

Route::group(['middleware' => 'prevent-back'], function () {
    Auth::routes();
    Route::get('/home', 'HomeController@index');
    //Route::resource('order', OrderController::class);
    Route::resource('home', HomeController::class);
    Route::resource('list', CustomerlistController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/list', [App\Http\Controllers\CustomerlistController::class, 'index'])->name('list');
    Route::get('/report', [App\Http\Controllers\ReportController::class, 'index'])->name('Report');
    Route::get('/report/list/{id}', [App\Http\Controllers\ReportController::class, 'indexReportList'])->name('ReportList');
    Route::get('/customerinput', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer');
    Route::get('/order/{id}', [App\Http\Controllers\OrderController::class, 'index'])->name('order');
    Route::post('/order/store', [App\Http\Controllers\OrderController::class, 'Store'])->name('StoreOrder');
    Route::post('/order/update/{id}', [App\Http\Controllers\OrderController::class, 'update'])->name('UpdateOrder');
    Route::post('/order/ActivityUpdate/{id}', [App\Http\Controllers\OrderController::class, 'updateactivity'])->name('UpdateActivity');
    Route::get('/order/delete/{id}', [App\Http\Controllers\OrderController::class, 'DestroyActivity'])->name('DestroyActivity');
    Route::post('/order/convert', [App\Http\Controllers\OrderController::class, 'ConvertCustomer'])->name('convert');
    Route::get('/list/delete/{id}', [App\Http\Controllers\HomeController::class, 'Destroy'])->name('DestroyCustomer');
    Route::get('/customer/query', [App\Http\Controllers\CustomerlistController::class, 'queryCustomerList']);
});
