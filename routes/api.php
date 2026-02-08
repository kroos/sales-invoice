<?php
use Illuminate\Support\Facades\Route;

// read API from files
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\API\ModelAjaxSupportController;

Route::middleware(['auth', 'auth:sanctum'])->group(function () {
	Route::controller(ModelAjaxSupportController::class)->group(function () {
		Route::get('/getActivityLogs', 'getActivityLogs')->name('getActivityLogs');
		Route::get('/getProducts', 'getProducts')->name('getProducts');
		Route::get('/getProductsdT', 'getProductsdT')->name('getProductsdT');
		Route::get('/getUser', 'getUser')->name('getUser');
		Route::get('/getCustomers', 'getCustomers')->name('getCustomers');
		Route::get('/getBanks', 'getBanks')->name('getBanks');
		Route::get('/getBanksT', 'getBanksT')->name('getBanksT');
		Route::get('/geSales', 'geSales')->name('geSales');
		Route::get('/getTaxes', 'getTaxes')->name('getTaxes');
		Route::get('/remoteusers', 'remoteusers')->name('remote.user');
		Route::get('/customersearch', 'customersearch')->name('customers.search');
		Route::post('/slipnumbersearch', 'slipnumbersearch')->name('slipnumbers.search');
		// Route::get('/getStaffSales', 'getStaffSales')->name('getStaffSales');
	});
});

