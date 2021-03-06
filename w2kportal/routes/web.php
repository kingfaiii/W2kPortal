<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectManagerController;

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

// Group Routes

Route::group(
    ['middleware' => 'prevent-back', 'middleware' => 'auth'],
    function () {
        Route::resource('home', HomeController::class);
        Route::resource('list', CustomerlistController::class);
        Route::resource('ProjectManager', ProjectManagerController::class);
        Route::get('/home', [
            App\Http\Controllers\HomeController::class,
            'index',
        ])->name('home');

        // List Function Routes
        Route::group(['prefix' => 'list'], function () {
            Route::get('/', [
                App\Http\Controllers\CustomerlistController::class,
                'index',
            ])->name('list');

            Route::get('/delete/{id}', [
                App\Http\Controllers\CustomerlistController::class,
                'Destroy',
            ])->name('DestroyCustomer');
        });

        Route::get('/customer/query', [
            App\Http\Controllers\CustomerlistController::class,
            'queryCustomerList',
        ]);

        // Won Function Routes
        Route::group(['prefix' => 'won'], function () {
            Route::get('/', [
                App\Http\Controllers\WonCustomerController::class,
                'index',
            ])->name('WonCustomers');

            Route::get('/Admin', [
                App\Http\Controllers\WonCustomerController::class,
                'wonGetAdmin',
            ])->name('wonAdmin');
            Route::post('/Admin/{id}', [
                App\Http\Controllers\WonCustomerController::class,
                'adminUpdate',
            ])->name('adminStore');
            Route::get('/Support', [
                App\Http\Controllers\WonCustomerController::class,
                'wonGetSupport',
            ])->name('wonSupport');
            Route::post('/Support/{id}', [
                App\Http\Controllers\WonCustomerController::class,
                'supportUpdate',
            ])->name('supportStore');

            Route::get('/books/{won_id}', [
                App\Http\Controllers\WonCustomerController::class,
                'woncustomerview',
            ])->name('WonCustomersbooklist');
            Route::get('/books/edit/{id}', [
                App\Http\Controllers\CustomerController::class,
                'index',
            ])->name('customer');
            Route::get('/books/history/{book_id}', [
                App\Http\Controllers\InclusionsLogController::class,
                'index',
            ])->name('HistoryLog');

            Route::get('/books/exports/{book_id}', [
                App\Http\Controllers\InclusionsLogController::class,
                'export_log',
            ])->name('ExportHistory');

            Route::post('/books/edit/update', [
                App\Http\Controllers\CustomerController::class,
                'update',
            ])->name('UpdateInclusions');
            Route::post('/books/information/update/{id}', [
                App\Http\Controllers\CustomerController::class,
                'updateBook',
            ])->name('upBookInfo');
        });

        // Reports Function Routes
        Route::get('/report', [
            App\Http\Controllers\ReportController::class,
            'index',
        ])->name('Report');
        Route::get('/report/list/{id}', [
            App\Http\Controllers\ReportController::class,
            'indexReportList',
        ])->name('ReportList');

        // Order Functions Routes
        Route::group(['prefix' => 'order'], function () {
            Route::get('/{id}', [
                App\Http\Controllers\OrderController::class,
                'index',
            ])->name('order');

            Route::post('/store', [
                App\Http\Controllers\OrderController::class,
                'Store',
            ])->name('StoreOrder');

            Route::post('/update/{id}', [
                App\Http\Controllers\OrderController::class,
                'update',
            ])->name('UpdateOrder');

            Route::post('/ActivityUpdate/{id}', [
                App\Http\Controllers\OrderController::class,
                'updateactivity',

            ])->name('UpdateActivity');
            Route::post('/UpdateCustomerInformation/{id}', [
                App\Http\Controllers\OrderController::class,
                'updateCustomerInformation',
            ])->name('updateCustomerInformation');

            Route::get('/delete/{id}', [
                App\Http\Controllers\OrderController::class,
                'DestroyActivity',
            ])->name('DestroyActivity');

            Route::get('/delete/book/{id}', [
                App\Http\Controllers\OrderController::class,
                'deleteServiceInclusions',
            ])->name('destroyBook');

            Route::post('/convert', [
                App\Http\Controllers\OrderController::class,
                'ConvertCustomer',
            ])->name('convert');


            Route::get('/list/packages/subscriptions/{sibling_id}/{package_id}/{setup}/{package_primary}', [
                App\Http\Controllers\OrderController::class,
                'package_siblings',
            ])->name('getCustomerPackages');

            Route::post('/modify/packages/subscriptions', [
                App\Http\Controllers\OrderController::class,
                'package_customize',
            ])->name('modifyCustomerPackage');
        });

        // Owners Functions Routes
        Route::group(['prefix' => 'owners'], function () {
            Route::get('/', [
                App\Http\Controllers\OwnerController::class,
                'index',
            ])->name('owner');
            Route::post('/add', [
                App\Http\Controllers\OwnerController::class,
                'create',
            ])->name('OwnerAdd');
            Route::post('/Update/{id}', [
                App\Http\Controllers\OwnerController::class,
                'update',
            ])->name('OwnerUpdate');
            Route::get('/Delete/{id}', [
                App\Http\Controllers\OwnerController::class,
                'destroy',
            ])->name('OwnerDelete');
        });

        Route::post('/update/service/inclusions', [
            App\Http\Controllers\CustomerController::class,
            'update',
        ])->name('updateInclusions');

        // Quality Assurance Functions Routes
        Route::group(['prefix' => 'qualityassurance'], function () {
            Route::get('/', [
                App\Http\Controllers\QualityAssuranceController::class,
                'index',
            ])->name('qualityassurance');
            Route::post('/add', [
                App\Http\Controllers\QualityAssuranceController::class,
                'create',
            ])->name('qaCreate');
            Route::post('/update/{id}', [
                App\Http\Controllers\QualityAssuranceController::class,
                'update',
            ])->name('qaUpdate');
            Route::get('/Delete/{id}', [
                App\Http\Controllers\QualityAssuranceController::class,
                'destroy',
            ])->name('qaDelete');
        });
    }
);
