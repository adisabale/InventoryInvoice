<?php

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
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/getProductAmount/{id}', [App\Http\Controllers\HomeController::class, 'getProductAmount'])->name('getProductAmount');
Route::post('/save-invoice', [App\Http\Controllers\HomeController::class, 'save'])->name('save.invoice');
Route::get('/view-invoice', [App\Http\Controllers\HomeController::class, 'view'])->name('view.invoice');
Route::get('/view-invoice-details/{id}', [App\Http\Controllers\HomeController::class, 'view_invoice'])->name('view.invoice.details');
