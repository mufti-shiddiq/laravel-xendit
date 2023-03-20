<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;

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

Route::prefix('bill')->group(function () {
    Route::get('/', [BillController::class, 'index'])->name('bill.index');
    Route::get('/create', [BillController::class, 'create'])->name('bill.create');
    Route::post('/store', [BillController::class, 'store'])->name('bill.store');
});
