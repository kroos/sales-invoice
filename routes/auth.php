<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\{
	UserController,
	UserGroupController,
	ProductCategoryController,
	ProductController,
	ProductImageController,
	BanksController,
	SalesController,
	PreferencesController,
	TaxesController,
	CustomersController,
	SlipPostageController,
	SalesItemsController,
	PaymentsController,
	SlipNumbersController,
	PrintPDFController,
	PrintReportController,
};


use App\Http\Controllers\API\ModelAjaxSupportController;


use App\Http\Controllers\System\ActivityLogController;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
	Route::get('/dashboard', function(){
		return view('dashboard');
	})->name('dashboard');
});

Route::middleware(['auth', 'password.confirm'])->group(function () {

	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

	Route::middleware('admin')->group(function () {
		Route::prefix('activity-logs')->name('activity-logs.')->group(function () {
			Route::get('/', [ActivityLogController::class, 'index'])->name('index');
			Route::get('/{log}', [ActivityLogController::class, 'show'])->name('show');
			Route::delete('/{log}', [ActivityLogController::class, 'destroy'])->name('destroy');
		})/*->middleware(['auth', 'role:owner'])*/;
	});
});

Route::middleware('auth')->group(function () {
	Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
	Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
	Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
	Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
	Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
	Route::put('password', [PasswordController::class, 'update'])->name('password.update');
	Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

####################################################################
	Route::middleware('admin')->group(function () {
		Route::resources([
			'users' => UserController::class,
			'taxes' => TaxesController::class,
		]);

		Route::prefix('usergroups')->name('usergroups.')->group(function () {
			Route::get('create', [UserGroupController::class, 'create'])->name('create');
			Route::post('store', [UserGroupController::class, 'store'])->name('store');
		});

		Route::prefix('preferences')->name('preferences.')->group(function () {
			Route::get('edit', [PreferencesController::class, 'edit'])->name('edit');
			Route::patch('{preference}/update', [PreferencesController::class, 'update'])->name('update');
		});
	});

	// only middleware auth
	Route::resources([
		'productcategories' => ProductCategoryController::class,
		'products' => ProductController::class,
		'banks' => BanksController::class,
	]);

	Route::get('banks/active/{banks}', [BanksController::class, 'active'])->name('banks.active');

	Route::prefix('productimages')->name('productimages.')->group(function () {
		Route::get('{productimage}/edit', [ProductImageController::class, 'edit'])->name('edit');
		Route::patch('{productimage}/update', [ProductImageController::class, 'update'])->name('update');
		Route::delete('{productimage}', [ProductImageController::class, 'destroy'])->name('destroy');
	});

	Route::prefix('sales')->name('sales.')->group(function () {
		Route::get('index', [SalesController::class, 'index'])->name('index');
		Route::get('create', [SalesController::class, 'create'])->name('create');
		Route::post('', [SalesController::class, 'store'])->name('store');

		Route::middleware('userownsale')->group(function () {
			Route::get('{sale}', [SalesController::class, 'show'])->name('show');
			Route::get('{sale}/edit', [SalesController::class, 'edit'])->name('edit');
			Route::patch('{sale}', [SalesController::class, 'update'])->name('update');
			Route::delete('{sale}', [SalesController::class, 'delete'])->name('delete');
		});
	});

	Route::prefix('customers')->name('customers.')->group(function () {
		Route::get('index', [CustomersController::class, 'index'])->name('index');
		Route::get('{customer}/edit', [CustomersController::class, 'edit'])->name('edit');
		Route::patch('{customer}', [CustomersController::class, 'update'])->name('update');
		Route::delete('{customer}', [CustomersController::class, 'destroy'])->name('destroy');
	});

	Route::controller(PrintPDFController::class)->group(function () {
		Route::get('printpdf/{sales}', 'print')->name('printpdf.print');
		Route::get('emailpdf/{sales}', 'email_invoice')->name('emailpdf.send');
	});

	Route::controller(PrintReportController::class)->group(function () {
		Route::get('printreport', 'index')->name('printreport.index');
		Route::post('printreport/store', 'store')->name('printreport.store');
		Route::post('printreport/audit', 'audit')->name('printreport.audit');
		Route::post('printreport/payment', 'payment')->name('printreport.payment');
	});

	Route::delete('slippostage/destroy', [SlipPostageController::class, 'destroy'])->name('slippostage.destroy');

	Route::delete('salesitems/destroy', [SalesItemsController::class, 'destroy'])->name('salesitems.destroy');

	Route::delete('payments/destroy', [PaymentsController::class, 'destroy'])->name('payments.destroy');

	Route::delete('slipnumbers/destroy', [SlipNumbersController::class, 'destroy'])->name('slipnumbers.destroy');
});










	Route::controller(ModelAjaxSupportController::class)->group(function () {
		Route::get('/getStaffSales', 'getStaffSales')->name('getStaffSales');
	});
