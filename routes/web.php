<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\Admin;

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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::post('/store_profile', [App\Http\Controllers\HomeController::class, 'store_profile'])->name('store_profile');
Route::post('/store_education', [App\Http\Controllers\HomeController::class, 'store_education'])->name('store_education');
Route::post('/store_work', [App\Http\Controllers\HomeController::class, 'store_work'])->name('store_work');
Route::post('/store_language', [App\Http\Controllers\HomeController::class, 'store_language'])->name('store_language');
Route::post('/store_certificate', [App\Http\Controllers\HomeController::class, 'store_certificate'])->name('store_certificate');
Route::post('/store_links', [App\Http\Controllers\HomeController::class, 'store_links'])->name('store_links');
Route::get('/loginverification', [App\Http\Controllers\HomeController::class, 'loginverification'])->name('loginverification');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
});