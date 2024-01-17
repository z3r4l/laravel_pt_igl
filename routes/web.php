<?php

use App\Http\Controllers\CategoryLetterController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


  
Auth::routes(['register' => false, 'password.request' => false, 'password.reset' => false]);
  
// Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function() {
    Route::get('/',[DashboardController::class, 'index']);
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::resource('daily-report', DailyReportController::class)->except('show');

    Route::resource('category-letter', CategoryLetterController::class)->except('show');
    Route::resource('letter', LetterController::class)->except('show');
    Route::get('lettter/print-letter/{letter}', [LetterController::class, 'printLetter'])->name('letter.printLetter');

    Route::resource('invoice', InvoiceController::class)->except('show');
    Route::get('invoice/print-invoice/{invoice}', [InvoiceController::class, 'printInvoice'])->name('invoice.printInvoice');

    Route::resource('company', CompanyController::class)->except('show');
});
