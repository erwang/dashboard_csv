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
Route::get('/addGraph/{type?}',[DashboardController::class,'addGraph'])->name('addGraph');
Route::get('/removeGraph/{uuid}',[DashboardController::class,'removeGraph'])->name('removeGraph');
Route::get('/d/{data}',[DashboardController::class,'fromData'])->name('fromData')->where('data','(.*)');

Route::get('/{url}/{rowTitle}/{columnDuration}/{columnDescription}/{column1}/{column2?}/{column3?}/{start?}/{end?}',[DashboardController::class,'fromLink'])->name('fromLink');
Route::match(array('GET', 'POST'),'/2',[DashboardController::class,'settings'])->name('settings');
Route::match(array('GET', 'POST'),'/3',[DashboardController::class,'dashboard'])->name('dashboard');

Route::get('mentionslegales',function(){
    return view('mentionslegales');
});
Route::get('roadmap',function(){
    return view('roadmap');
});


