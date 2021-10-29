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
    Route::get('/won', [App\Http\Controllers\WonCustomerController::class, 'index'])->name('WonCustomers');
    Route::get('/won/books/{won_id}', [App\Http\Controllers\WonCustomerController::class, 'woncustomerview'])->name('WonCustomersbooklist');
    Route::get('/report/list/{id}', [App\Http\Controllers\ReportController::class, 'indexReportList'])->name('ReportList');
    Route::get('/won/books/edit/{id}', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer');
    Route::get('/order/{id}', [App\Http\Controllers\OrderController::class, 'index'])->name('order');
    Route::post('/order/store', [App\Http\Controllers\OrderController::class, 'Store'])->name('StoreOrder');
    Route::post('/order/update/{id}', [App\Http\Controllers\OrderController::class, 'update'])->name('UpdateOrder');
    Route::post('/order/ActivityUpdate/{id}', [App\Http\Controllers\OrderController::class, 'updateactivity'])->name('UpdateActivity');
    Route::post('/won/books/edit/update', [App\Http\Controllers\CustomerController::class, 'update'])->name('UpdateInclusions');
    Route::get('/order/delete/{id}', [App\Http\Controllers\OrderController::class, 'DestroyActivity'])->name('DestroyActivity');
    Route::post('/order/convert', [App\Http\Controllers\OrderController::class, 'ConvertCustomer'])->name('convert');
    Route::get('/list/delete/{id}', [App\Http\Controllers\HomeController::class, 'Destroy'])->name('DestroyCustomer');
    Route::get('/customer/query', [App\Http\Controllers\CustomerlistController::class, 'queryCustomerList']);

    Route::get('/owners', [App\Http\Controllers\OwnerController::class, 'index'])->name('owner');
    Route::post('/update/service/inclusions', [App\Http\Controllers\CustomerController::class, 'update'])->name('updateInclusions');
    Route::post('/owner/add', [App\Http\Controllers\OwnerController::class, 'create'])->name('OwnerAdd');
    Route::post('/owner/Update/{id}', [App\Http\Controllers\OwnerController::class, 'update'])->name('OwnerUpdate');
    Route::get('/owner/Delete/{id}', [App\Http\Controllers\OwnerController::class, 'destroy'])->name('OwnerDelete');

    Route::get('/qualityassurance', [App\Http\Controllers\QualityAssuranceController::class, 'index'])->name('qualityassurance');
    Route::post('/qualityassurance/add', [App\Http\Controllers\QualityAssuranceController::class, 'create'])->name('qaCreate');
    Route::post('/qualityassurance/update/{id}', [App\Http\Controllers\QualityAssuranceController::class, 'update'])->name('qaUpdate');
});
