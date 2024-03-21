<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;

Route::resource('transactions', TransactionController::class);
Route::get('/transaction/buy', [TransactionController::class, 'formBuy'])->name('transactions.formBuy');
Route::post('/transaction/buy', [TransactionController::class, 'buy'])->name('transactions.buy');

Route::resource('stocks', StockController::class);
Route::resource('products', ProductController::class);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
