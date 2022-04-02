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

Route::get('/sharing/u/{data}',[\App\Http\Controllers\SharingController::class,'createUpdateLink'])->name('createUpdateLink')->where('data','(.*)');
Route::get('/u/{link}',[\App\Http\Controllers\SharingController::class,'fromUpdateLink'])->name('fromUpdateLink');

Route::get('/sharing/r/{data}',[\App\Http\Controllers\SharingController::class,'createReadonlyLink'])->name('createReadonlyLink')->where('data','(.*)');
Route::get('/r/{link}',[\App\Http\Controllers\SharingController::class,'fromReadonlyLink'])->name('fromReadonlyLink');



Route::get('/{url}/{rowTitle}/{columnDuration}/{columnDescription}/{column1}/{column2?}/{column3?}/{start?}/{end?}',[DashboardController::class,'fromLink'])->name('fromLink');
Route::match(array('GET', 'POST'),'/2',[DashboardController::class,'settings'])->name('settings');
Route::match(array('GET', 'POST'),'/3',[DashboardController::class,'dashboard'])->name('dashboard');

Route::get('mentionslegales',function(){
    return view('mentionslegales');
});
Route::get('roadmap',function(){
    return view('roadmap');
});

Route::get('demo',function(){
    return redirect('https://dashboard.jouga.net/d/eyJ1cmwiOiJodHRwczpcL1wvZG9jcy5nb29nbGUuY29tXC9zcHJlYWRzaGVldHNcL2RcL2VcLzJQQUNYLTF2UWh5WDFROHNqQ2J4UEdTVlNLQ1dGbVpucF9QaHBCTnVrQzF0Q3hlUnphdkkyd3lIMTdiY09UazdCU3d6NC1TYU1aTE5zSDFxS1BXYmtwXC9wdWI/Z2lkPTQ0NzE1NzU0OSZzaW5nbGU9dHJ1ZSZvdXRwdXQ9Y3N2Iiwicm93VGl0bGUiOiIxIiwiY29sdW1uRGVzY3JpcHRpb24iOiIxIiwiY29sdW1uRHVyYXRpb24iOiIyIiwiZ3JhcGhzIjpbeyJjb2x1bW4iOiIxNSIsIm5iQ29scyI6IjMiLCJ0eXBlIjoiZG91Z2hudXQiLCJ1dWlkIjoiZTM3ZTA4NGItNGI5NC00ZjhiLWIwNGItMzZkYTNkY2I2MTYxIiwic3RhcnQiOm51bGwsImVuZCI6bnVsbCwib3JkZXIiOjEsIl90b2tlbiI6InMwalZMTkU1eWZuSkxubE1YVzNkQVdyVVh1c3dvd0hJM1BlakZwUDIiLCJncmFwaCI6ImUzN2UwODRiLTRiOTQtNGY4Yi1iMDRiLTM2ZGEzZGNiNjE2MSJ9LHsiY29sdW1uIjoiMTUiLCJuYkNvbHMiOiIzIiwidHlwZSI6InJhZGFyIiwidXVpZCI6IjJlM2U0ZTAyLTZmMjItNGViNS04YmNhLTEwOTRhOWUzY2MxYiIsInN0YXJ0IjpudWxsLCJlbmQiOm51bGwsIm9yZGVyIjoyLCJfdG9rZW4iOiJzMGpWTE5FNXlmbkpMbmxNWFczZEFXclVYdXN3b3dISTNQZWpGcFAyIiwiZ3JhcGgiOiIyZTNlNGUwMi02ZjIyLTRlYjUtOGJjYS0xMDk0YTllM2NjMWIifSx7InR5cGUiOiJoaXN0b2dyYW1tZSIsInV1aWQiOiI1NDEzOGQ4ZS1lZTNlLTQ5MWYtOTE1Yy1lNWFlMmE4ZmYwMGUiLCJzdGFydCI6IjAxLjAxIiwiZW5kIjoiMDEuMTEiLCJjb2x1bW5zIjpbIjQxIiwiNDIiLCI0MyJdLCJfdG9rZW4iOiJzMGpWTE5FNXlmbkpMbmxNWFczZEFXclVYdXN3b3dISTNQZWpGcFAyIiwiZ3JhcGgiOiI1NDEzOGQ4ZS1lZTNlLTQ5MWYtOTE1Yy1lNWFlMmE4ZmYwMGUiLCJvcmRlciI6MywibmJDb2xzIjoiNiJ9LHsiY29sdW1uMSI6IjIzIiwidXVpZCI6IjVhZTg5NWZhLWFjM2MtNGUxZi1iY2NiLWZmZDA4MTc4Y2M4YyIsInR5cGUiOiJ0aW1lbGluZSIsInN0YXJ0IjoiMDEuMDEiLCJlbmQiOiIwMS4xMSIsIl90b2tlbiI6InMwalZMTkU1eWZuSkxubE1YVzNkQVdyVVh1c3dvd0hJM1BlakZwUDIiLCJncmFwaCI6IjVhZTg5NWZhLWFjM2MtNGUxZi1iY2NiLWZmZDA4MTc4Y2M4YyIsImNvbHVtbjIiOm51bGwsImNvbHVtbjMiOm51bGwsInRpbWVJbnRlcnZhbCI6bnVsbCwibmJDb2xzIjoiMTIiLCJvcmRlciI6NH1dLCJfdG9rZW4iOiJzMGpWTE5FNXlmbkpMbmxNWFczZEFXclVYdXN3b3dISTNQZWpGcFAyIiwibmV4dCI6ImRhc2hib2FyZCIsImNvbHVtbjEiOiIyMyIsImdyYXBoIjoiNTQxMzhkOGUtZWUzZS00OTFmLTkxNWMtZTVhZTJhOGZmMDBlIiwiY29sdW1ucyI6WyI0MSIsIjQyIiwiNDMiXSwic3RhcnQiOiIwMS4wMSIsImVuZCI6IjAxLjExIiwiY29sdW1uMiI6bnVsbCwiY29sdW1uMyI6bnVsbCwidGltZUludGVydmFsIjpudWxsLCJuYkNvbHMiOiI2Iiwib3JkZXIiOiIzIiwiY29sdW1uIjoiMTUifQ==');
});


