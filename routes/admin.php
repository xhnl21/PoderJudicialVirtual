<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('admin.index');
Route::post('/comprar', [DashboardController::class, 'comprar'])->name('admin.comprar');
Route::get('/producto', [DashboardController::class, 'indexAdmin'])->name('admin.producto');
Route::get('/form/{id}', [DashboardController::class, 'form'])->name('admin.form');
Route::post('/crear', [DashboardController::class, 'crear'])->name('admin.crear');
Route::get('/destroy/{id}', [DashboardController::class, 'destroy'])->name('admin.destroy');
Route::get('/createPDF', [DashboardController::class, 'createPDF'])->name('admin.createPDF');
Route::get('/createPDFD/{id}', [DashboardController::class, 'createPDFD'])->name('admin.createPDFD');
Route::get('/factura', [DashboardController::class, 'factura'])->name('admin.factura');