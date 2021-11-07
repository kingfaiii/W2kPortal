<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/', function () {
    return redirect('login');
});
Auth::routes();

// Group Routes

Route::group(['middleware' => 'prevent-back', 'middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index');
    Route::resource('home', HomeController::class);
    Route::resource('list', CustomerlistController::class);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // List Function Routes
    Route::group(['prefix' => 'list'], function () {
        Route::get('/', [App\Http\Controllers\CustomerlistController::class, 'index'])->name('list');
        Route::get('/delete/{id}', [App\Http\Controllers\CustomerlistController::class, 'Destroy'])->name('DestroyCustomer');
    });

    Route::get('/customer/query', [App\Http\Controllers\CustomerlistController::class, 'queryCustomerList']);

    // Won Function Routes
    Route::group(['prefix' => 'won'], function () {
        Route::get('/', [App\Http\Controllers\WonCustomerController::class, 'index'])->name('WonCustomers');
        Route::get('/books/{won_id}', [App\Http\Controllers\WonCustomerController::class, 'woncustomerview'])->name('WonCustomersbooklist');
        Route::get('/books/edit/{id}', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer');
        Route::get('/books/history/{book_id}', [App\Http\Controllers\InclusionsLogController::class, 'index'])->name('HistoryLog');
        Route::post('/books/edit/update', [App\Http\Controllers\CustomerController::class, 'update'])->name('UpdateInclusions');
    });


    // Reports Function Routes
    Route::get('/report', [App\Http\Controllers\ReportController::class, 'index'])->name('Report');
    Route::get('/report/list/{id}', [App\Http\Controllers\ReportController::class, 'indexReportList'])->name('ReportList');


    // Order Functions Routes
    Route::group(['prefix' => 'order'], function () {
        Route::get('/{id}', [App\Http\Controllers\OrderController::class, 'index'])->name('order');
        Route::post('/store', [App\Http\Controllers\OrderController::class, 'Store'])->name('StoreOrder');
        Route::post('/update/{id}', [App\Http\Controllers\OrderController::class, 'update'])->name('UpdateOrder');
        Route::post('/ActivityUpdate/{id}', [App\Http\Controllers\OrderController::class, 'updateactivity'])->name('UpdateActivity');
        Route::get('/delete/{id}', [App\Http\Controllers\OrderController::class, 'DestroyActivity'])->name('DestroyActivity');
        Route::post('/convert', [App\Http\Controllers\OrderController::class, 'ConvertCustomer'])->name('convert');
    });


    // Owners Functions Routes
    Route::group(['prefix' => 'owners'], function () {
        Route::get('/', [App\Http\Controllers\OwnerController::class, 'index'])->name('owner');
        Route::post('/add', [App\Http\Controllers\OwnerController::class, 'create'])->name('OwnerAdd');
        Route::post('/Update/{id}', [App\Http\Controllers\OwnerController::class, 'update'])->name('OwnerUpdate');
        Route::get('/Delete/{id}', [App\Http\Controllers\OwnerController::class, 'destroy'])->name('OwnerDelete');
    });

    Route::post('/update/service/inclusions', [App\Http\Controllers\CustomerController::class, 'update'])->name('updateInclusions');


    // Quality Assurance Functions Routes
    Route::group(['prefix' => 'qualityassurance'], function () {
        Route::get('/', [App\Http\Controllers\QualityAssuranceController::class, 'index'])->name('qualityassurance');
        Route::post('/add', [App\Http\Controllers\QualityAssuranceController::class, 'create'])->name('qaCreate');
        Route::post('/update/{id}', [App\Http\Controllers\QualityAssuranceController::class, 'update'])->name('qaUpdate');
        Route::get('/Delete/{id}', [App\Http\Controllers\QualityAssuranceController::class, 'destroy'])->name('qaDelete');
    });
});
