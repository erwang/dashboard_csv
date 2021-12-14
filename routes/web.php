<?php

use App\Http\Controllers\DashboardController;
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

Route::get('/language/{language}',[DashboardController::class,'changeLanguage'])->name('changeLanguage');

Route::get('/',[DashboardController::class,'file'])->name('file');
Route::get('/reset',[DashboardController::class,'reset'])->name('reset');
Route::match(array('GET', 'POST'),'/2',[DashboardController::class,'settings'])->name('settings');
Route::match(array('GET', 'POST'),'/3',[DashboardController::class,'dashboard'])->name('dashboard');


