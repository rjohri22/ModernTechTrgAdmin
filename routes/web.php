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
Route::get('/apply_job/{id}', [App\Http\Controllers\HomeController::class, 'apply_job'])->name('apply_job');
Route::post('/store_apply_job/{id}', [App\Http\Controllers\HomeController::class, 'store_apply_job'])->name('store_apply_job');
Route::get('/thankyou', [App\Http\Controllers\HomeController::class, 'thankyou'])->name('thankyou');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/oppertunities', [Admin\OppertunitiesController::class, 'index'])->name('admin.oppertunities');
    Route::get('/oppertunities/add', [Admin\OppertunitiesController::class, 'add'])->name('admin.add_oppertunities');
    Route::get('/oppertunities/edit/{id}', [Admin\OppertunitiesController::class, 'edit'])->name('admin.edit_oppertunities');
    Route::get('/oppertunities/view/{id}', [Admin\OppertunitiesController::class, 'view'])->name('admin.view_oppertunities');
    Route::post('/oppertunities/store_oppertunity', [Admin\OppertunitiesController::class, 'store_oppertunity'])->name('admin.store_oppertunity');
    Route::post('/oppertunities/update_oppertunity/{id}', [Admin\OppertunitiesController::class, 'update_oppertunity'])->name('admin.update_oppertunity');
    Route::get('/oppertunities/delete_oppertunity/{id}', [Admin\OppertunitiesController::class, 'delete_oppertunity'])->name('admin.delete_oppertunity');


    Route::get('/job_applications', [Admin\JobapplicationsController::class, 'index'])->name('admin.job_applications');
    Route::get('/job_applications/add', [Admin\JobapplicationsController::class, 'add'])->name('admin.add_job_applications');
    Route::get('/job_applications/edit/{id}', [Admin\JobapplicationsController::class, 'edit'])->name('admin.edit_job_applications');
    Route::get('/job_applications/view/{id}', [Admin\JobapplicationsController::class, 'view'])->name('admin.view_job_applications');
    
    Route::post('/job_applications/store_application', [Admin\JobapplicationsController::class, 'store_application'])->name('admin.store_application');
    Route::post('/job_applications/update_application/{id}', [Admin\JobapplicationsController::class, 'update_application'])->name('admin.update_application');
    
    Route::get('/job_applications/delete_application/{id}', [Admin\JobapplicationsController::class, 'delete_application'])->name('admin.delete_application');


    Route::get('/job_seeker', [Admin\JobSeekerController::class, 'index'])->name('admin.job_seeker');
    Route::get('/job_seeker/add', [Admin\JobSeekerController::class, 'add'])->name('admin.add_job_seeker');
    Route::get('/job_seeker/edit/{id}', [Admin\JobSeekerController::class, 'edit'])->name('admin.edit_job_seeker');
    Route::get('/job_seeker/view/{id}', [Admin\JobSeekerController::class, 'view'])->name('admin.view_job_seeker');
    
    Route::post('/job_seeker/store_job_seeker', [Admin\JobSeekerController::class, 'store_job_seeker'])->name('admin.store_job_seeker');
    Route::post('/job_seeker/update_job_seeker/{id}', [Admin\JobSeekerController::class, 'update_job_seeker'])->name('admin.update_job_seeker');
    
    Route::get('/job_seeker/delete_job_seeker/{id}', [Admin\JobSeekerController::class, 'delete_job_seeker'])->name('admin.delete_job_seeker');

    
    Route::get('/interview', [Admin\InterviewController::class, 'index'])->name('admin.interview');
    Route::post('/interview', [Admin\InterviewController::class, 'index'])->name('admin.interview_post');
    



    Route::get('/interview/edit/{id}', [Admin\InterviewController::class, 'edit'])->name('admin.edit_interview');

    Route::post('/interview/update_interview/{id}', [Admin\InterviewController::class, 'update_interview'])->name('admin.update_interview');
    
    Route::get('/interview/delete_interview/{id}', [Admin\InterviewController::class, 'delete_interview'])->name('admin.delete_interview');
});