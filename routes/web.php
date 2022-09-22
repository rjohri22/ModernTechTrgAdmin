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

// Confilate Code Start
Route::get('/index',function(){
    return view('index');
});

Route::get('/jobSeeker',function(){
    return view('jobSeeker');
});


//---------------------------

Route::get('/', [App\Http\Controllers\FrontController::class, 'career'])->name('home');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Confilate Code End


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/server_reset', [App\Http\Controllers\ServerresetController::class, 'index'])->name('server_reset');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
// Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::post('/store_profile', [App\Http\Controllers\HomeController::class, 'store_profile'])->name('store_profile');
Route::post('/store_education', [App\Http\Controllers\HomeController::class, 'store_education'])->name('store_education');
Route::post('/store_work', [App\Http\Controllers\HomeController::class, 'store_work'])->name('store_work');
Route::post('/store_language', [App\Http\Controllers\HomeController::class, 'store_language'])->name('store_language');
Route::post('/store_certificate', [App\Http\Controllers\HomeController::class, 'store_certificate'])->name('store_certificate');
Route::post('/store_links', [App\Http\Controllers\HomeController::class, 'store_links'])->name('store_links');
Route::get('/loginverification', [App\Http\Controllers\HomeController::class, 'loginverification'])->name('loginverification');
Route::get('/apply_job/{id}', [App\Http\Controllers\HomeController::class, 'apply_job'])->name('apply_job');
Route::post('/store_apply_job/{id}', [App\Http\Controllers\HomeController::class, 'store_apply_job'])->name('store_apply_job');
Route::get('/my_jobs', [App\Http\Controllers\HomeController::class, 'myjobs'])->name('myjobs');
Route::get('/thankyou', [App\Http\Controllers\HomeController::class, 'thankyou'])->name('thankyou');
Route::get('/career', [App\Http\Controllers\FrontController::class, 'career'])->name('career');
Route::post('/apply_for_job', [App\Http\Controllers\HomeController::class, 'apply_for_job'])->name('apply_for_job');
Route::get('/attempt_interview/{id}', [App\Http\Controllers\FrontController::class, 'attempt_interview'])->name('attempt_interview');


Route::post('/store_attempt_interview/{id}', [App\Http\Controllers\FrontController::class, 'store_attempt_interview'])->name('store_attempt_interview');


Route::prefix('admin')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index']);
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/oppertunities', [Admin\OppertunitiesController::class, 'index'])->name('admin.oppertunities');
    Route::get('/oppertunities/add', [Admin\OppertunitiesController::class, 'add'])->name('admin.add_oppertunities');
    Route::get('/oppertunities/edit/{id}', [Admin\OppertunitiesController::class, 'edit'])->name('admin.edit_oppertunities');
    Route::get('/oppertunities/view/{id}', [Admin\OppertunitiesController::class, 'view'])->name('admin.view_oppertunities');
    Route::get('/oppertunities/publish/{id}', [Admin\OppertunitiesController::class, 'publish'])->name('admin.publish_oppertunities');
    Route::post('/oppertunities/store_oppertunity', [Admin\OppertunitiesController::class, 'store_oppertunity'])->name('admin.store_oppertunity');
    Route::post('/oppertunities/update_oppertunity/{id}', [Admin\OppertunitiesController::class, 'update_oppertunity'])->name('admin.update_oppertunity');
    Route::get('/oppertunities/delete_oppertunity/{id}', [Admin\OppertunitiesController::class, 'delete_oppertunity'])->name('admin.delete_oppertunity');


    // Route::get('/job_applications/{status}', [Admin\JobapplicationsController::class, 'index'])->name('admin.job_applications');
    // Route::get('/job_applications/add', [Admin\JobapplicationsController::class, 'add'])->name('admin.add_job_applications');
    // Route::get('/job_applications/edit/{id}', [Admin\JobapplicationsController::class, 'edit'])->name('admin.edit_job_applications');
    // Route::get('/job_applications/view/{id}', [Admin\JobapplicationsController::class, 'view'])->name('admin.view_job_applications');
    
    // Route::post('/job_applications/store_application', [Admin\JobapplicationsController::class, 'store_application'])->name('admin.store_application');
    // Route::post('/job_applications/update_application/{id}', [Admin\JobapplicationsController::class, 'update_application'])->name('admin.update_application');
    
    // Route::get('/job_applications/delete_application/{id}', [Admin\JobapplicationsController::class, 'delete_application'])->name('admin.delete_application');


    Route::get('/job_seeker', [Admin\JobseekerController::class, 'index'])->name('admin.job_seeker');
    Route::get('/job_seeker/view/{id}', [Admin\JobseekerController::class, 'view'])->name('admin.view_job_seeker');
    Route::get('/job_seeker/delete_job_seeker/{id}', [Admin\JobseekerController::class, 'delete_job_seeker'])->name('admin.delete_job_seeker');
    Route::post('/job_seeker/assign_job_status_update', [Admin\JobseekerController::class, 'assign_job_status_update'])->name('admin.assign_jbs');


    
    Route::get('/employees', [Admin\EmployeesController::class, 'index'])->name('admin.employees');
    Route::get('/employees/add', [Admin\EmployeesController::class, 'add'])->name('admin.add_employee');
    Route::get('/employees/edit/{id}', [Admin\EmployeesController::class, 'edit'])->name('admin.edit_employee');
    Route::get('/employees/view/{id}', [Admin\EmployeesController::class, 'view'])->name('admin.view_employee');
    
    //profile
    Route::get('/profile/view', [Admin\ProfileController::class, 'view'])->name('admin.view_profile');
    Route::post('/profile/update_profile_resume/{id}', [Admin\ProfileController::class, 'update_profile_resume'])->name('admin.update_profile_resume');
    Route::post('/profile/store_profile_education/{id}', [Admin\ProfileController::class, 'store_profile_education'])->name('admin.store_profile_education');
    Route::post('/employees/store_profile_experience/{id}', [Admin\ProfileController::class, 'store_profile_experience'])->name('admin.store_profile_experience');
    Route::post('/employees/store_profile_certificate/{id}', [Admin\ProfileController::class, 'store_profile_certificate'])->name('admin.store_profile_certificate');
    Route::post('/employees/store_profile_language/{id}', [Admin\ProfileController::class, 'store_profile_language'])->name('admin.store_profile_language');
    Route::post('/employees/store_profile_link/{id}', [Admin\ProfileController::class, 'store_profile_link'])->name('admin.store_profile_link');


    Route::post('/employees/store_employee', [Admin\EmployeesController::class, 'store_employee'])->name('admin.store_employee');

    Route::post('/employees/update_employee/{id}', [Admin\EmployeesController::class, 'update_employee'])->name('admin.update_employee');

    Route::post('/employees/update_user_resume/{id}', [Admin\EmployeesController::class, 'update_user_resume'])->name('admin.update_user_resume');

    Route::post('/employees/store_user_education/{id}', [Admin\EmployeesController::class, 'store_user_education'])->name('admin.store_user_education');

    Route::post('/employees/store_user_experience/{id}', [Admin\EmployeesController::class, 'store_user_experience'])->name('admin.store_user_experience');

    Route::post('/employees/store_user_certificate/{id}', [Admin\EmployeesController::class, 'store_user_certificate'])->name('admin.store_user_certificate');

    Route::post('/employees/store_user_language/{id}', [Admin\EmployeesController::class, 'store_user_language'])->name('admin.store_user_language');

    Route::post('/employees/store_user_link/{id}', [Admin\EmployeesController::class, 'store_user_link'])->name('admin.store_user_link');

    Route::post('/employees/change_user_profile/{id}', [Admin\EmployeesController::class, 'change_user_profile'])->name('admin.change_user_profile');
    
    Route::post('/employees/change_password/{id}', [Admin\EmployeesController::class, 'change_password'])->name('admin.change_password');
    
    Route::get('/employees/delete_employee/{id}', [Admin\EmployeesController::class, 'delete_employee'])->name('admin.delete_employee');

    
    Route::get('/interview', [Admin\InterviewController::class, 'index'])->name('admin.interview');
    Route::post('/interview', [Admin\InterviewController::class, 'index'])->name('admin.interview_post');
    Route::get('/interview/edit/{id}', [Admin\InterviewController::class, 'edit'])->name('admin.edit_interview');
    Route::post('/interview/update_interview/{id}', [Admin\InterviewController::class, 'update_interview'])->name('admin.update_interview');
    Route::get('/interview/delete_interview/{id}', [Admin\InterviewController::class, 'delete_interview'])->name('admin.delete_interview');
    Route::post('/change_status', [Admin\DashboardController::class, 'change_status'])->name('admin.change_status');



    Route::get('/groups', [Admin\GroupController::class, 'index'])->name('admin.groups');
    Route::get('/groups/add', [Admin\GroupController::class, 'add'])->name('admin.group_add');
    Route::get('/groups/edit/{id}', [Admin\GroupController::class, 'edit'])->name('admin.group_edit');
    Route::post('/groups/store', [Admin\GroupController::class, 'store'])->name('admin.group_store');
    Route::post('/groups/update/{id}', [Admin\GroupController::class, 'update'])->name('admin.group_update');
    Route::get('/groups/delete/{id}', [Admin\GroupController::class, 'delete'])->name('admin.group_delete');

    Route::get('/designations', [Admin\DesignationController::class, 'index'])->name('admin.designations');
    Route::get('/designations/add', [Admin\DesignationController::class, 'add'])->name('admin.designation_add');
    Route::get('/designations/edit/{id}', [Admin\DesignationController::class, 'edit'])->name('admin.designation_edit');
    Route::post('/designations/store', [Admin\DesignationController::class, 'store'])->name('admin.designation_store');
    Route::post('/designations/update/{id}', [Admin\DesignationController::class, 'update'])->name('admin.designation_update');
    Route::get('/designations/delete/{id}', [Admin\DesignationController::class, 'delete'])->name('admin.designation_delete');

    Route::get('/departments', [Admin\DepartmentController::class, 'index'])->name('admin.departments');
    Route::get('/departments/add', [Admin\DepartmentController::class, 'add'])->name('admin.department_add');
    Route::get('/departments/edit/{id}', [Admin\DepartmentController::class, 'edit'])->name('admin.department_edit');
    Route::post('/departments/store', [Admin\DepartmentController::class, 'store'])->name('admin.department_store');
    Route::post('/departments/update/{id}', [Admin\DepartmentController::class, 'update'])->name('admin.department_update');
    Route::get('/departments/delete/{id}', [Admin\DepartmentController::class, 'delete'])->name('admin.department_delete');

    Route::get('/states', [Admin\StatesController::class, 'index'])->name('admin.states');
    Route::get('/states/add', [Admin\StatesController::class, 'add'])->name('admin.states_add');
    Route::get('/states/edit/{id}', [Admin\StatesController::class, 'edit'])->name('admin.states_edit');
    Route::post('/states/store', [Admin\StatesController::class, 'store'])->name('admin.states_store');
    Route::post('/states/update/{id}', [Admin\StatesController::class, 'update'])->name('admin.states_update');
    Route::get('/states/delete/{id}', [Admin\StatesController::class, 'delete'])->name('admin.states_delete');



    //countries
    Route::get('/countries', [Admin\CountryController::class, 'index'])->name('admin.countries');
    Route::get('/countries/add', [Admin\CountryController::class, 'add'])->name('admin.countries_add');
    Route::post('/countries/store', [Admin\CountryController::class, 'store'])->name('admin.countries_store');
    Route::get('/countries/edit/{id}', [Admin\CountryController::class, 'edit'])->name('admin.countries_edit');
    Route::post('/countries/update/{id}', [Admin\CountryController::class, 'update'])->name('admin.countries_update');
    Route::get('/countries/delete/{id}', [Admin\CountryController::class, 'delete'])->name('admin.countries_delete');





    Route::get('/cities', [Admin\CitiesController::class, 'index'])->name('admin.cities');
    Route::get('/cities/add', [Admin\CitiesController::class, 'add'])->name('admin.cities_add');
    Route::get('/cities/edit/{id}', [Admin\CitiesController::class, 'edit'])->name('admin.cities_edit');
    Route::post('/cities/store', [Admin\CitiesController::class, 'store'])->name('admin.cities_store');
    Route::post('/cities/update/{id}', [Admin\CitiesController::class, 'update'])->name('admin.cities_update');
    Route::get('/cities/delete/{id}', [Admin\CitiesController::class, 'delete'])->name('admin.cities_delete');
    Route::post('/cities/states', [Admin\CitiesController::class, 'states'])->name('admin.cities_states');
    Route::post('/cities/lists', [Admin\CitiesController::class, 'cities'])->name('admin.cities_list');

    Route::get('/busniess', [Admin\BusniessController::class, 'index'])->name('admin.busniess');
    Route::get('/busniess/add', [Admin\BusniessController::class, 'add'])->name('admin.busniess_add');
    Route::get('/busniess/edit/{id}', [Admin\BusniessController::class, 'edit'])->name('admin.busniess_edit');
    Route::post('/busniess/store', [Admin\BusniessController::class, 'store'])->name('admin.busniess_store');
    Route::post('/busniess/update/{id}', [Admin\BusniessController::class, 'update'])->name('admin.busniess_update');
    Route::get('/busniess/delete/{id}', [Admin\BusniessController::class, 'delete'])->name('admin.busniess_delete');

    Route::post('/busniess/crop', [Admin\BusniessController::class, 'uploadCropImage'])->name('admin.crop');



    Route::get('/bends', [Admin\BendController::class, 'index'])->name('admin.bends');
    Route::get('/bend/add', [Admin\BendController::class, 'add'])->name('admin.bend_add');
    Route::get('/bend/edit/{id}', [Admin\BendController::class, 'edit'])->name('admin.bend_edit');
    Route::post('/bend/store', [Admin\BendController::class, 'store'])->name('admin.bend_store');
    Route::post('/bend/update/{id}', [Admin\BendController::class, 'update'])->name('admin.bend_update');
    Route::get('/bend/delete/{id}', [Admin\BendController::class, 'delete'])->name('admin.bend_delete');




    //permission
    Route::get('/bend/permission/{id}', [Admin\BendController::class, 'permission'])->name('admin.bend_permission');
    Route::post('/bend/permission_update/{id}', [Admin\BendController::class, 'permission_update'])->name('admin.bend_permission_update');

    Route::get('/business_location', [Admin\BusinessLocationController::class, 'index'])->name('admin.business_locations');
    Route::get('/business_location/add', [Admin\BusinessLocationController::class, 'add'])->name('admin.business_location_add');
    Route::get('/business_location/edit/{id}', [Admin\BusinessLocationController::class, 'edit'])->name('admin.business_location_edit');
    Route::post('/business_location/store', [Admin\BusinessLocationController::class, 'store'])->name('admin.business_location_store');
    Route::post('/business_location/update/{id}', [Admin\BusinessLocationController::class, 'update'])->name('admin.business_location_update');
    Route::get('/business_location/delete/{id}', [Admin\BusinessLocationController::class, 'delete'])->name('admin.business_location_delete');


    Route::get('/jobs', [Admin\JobController::class, 'index'])->name('admin.jobs');
    Route::get('/assign_objective/{id}', [Admin\JobController::class, 'assign_objective'])->name('admin.assign_objective');


    Route::get('/approve_hr/{id}', [Admin\JobController::class, 'approve_hr'])->name('admin.approve_hr');
    
    Route::get('/approved', [Admin\JobController::class, 'approved'])->name('admin.approved');
    Route::get('/jobs/add', [Admin\JobController::class, 'add'])->name('admin.add_job');
    Route::get('/jobs/edit/{id}', [Admin\JobController::class, 'edit'])->name('admin.edit_job');
    Route::get('/jobs/view/{id}', [Admin\JobController::class, 'view'])->name('admin.view_job');
    Route::post('/jobs/store_oppertunity', [Admin\JobController::class, 'store'])->name('admin.store_job');
    Route::post('/jobs/update_oppertunity/{id}', [Admin\JobController::class, 'update'])->name('admin.update_job');
    Route::get('/jobs/delete_oppertunity/{id}', [Admin\JobController::class, 'delete'])->name('admin.delete_job');
    Route::get('/jobs/job_approved_manager/{id}', [Admin\JobController::class, 'job_approved_manager'])->name('admin.job_approved_manager');
    Route::get('/jobs/job_approved_hr/{id}', [Admin\JobController::class, 'job_approved_hr'])->name('admin.job_approved_hr');
    Route::post('/jobs/load_country', [Admin\JobController::class, 'load_country'])->name('admin.load_country');
    Route::post('/jobs/load_states', [Admin\JobController::class, 'load_states'])->name('admin.load_states');
    
    Route::post('/jobs/store_approv_hr/{id}', [Admin\JobController::class, 'store_approv_hr'])->name('admin.store_approv_hr');


    Route::post('/jobs/store_approv_country/{id}', [Admin\JobController::class, 'store_approv_country'])->name('admin.store_approv_country');

    Route::post('/jobs/store_approv_hr_head/{id}', [Admin\JobController::class, 'store_approv_hr_head'])->name('admin.store_approv_hr_head');





    Route::get('/settings/emailsmtp', [Admin\SettingController::class, 'emailsmpt'])->name('admin.setting.emailsmtp');
    Route::post('/settings/emailsmtp/store_setting', [Admin\SettingController::class, 'store_setting'])->name('admin.store_setting');

    Route::post('/settings/emailsmtp/test_email', [Admin\SettingController::class, 'test_email'])->name('admin.test_email');

    Route::post('/load_business_country', [Admin\DashboardController::class, 'load_business_country'])->name('admin.load_business_country');
    Route::post('/load_business_state', [Admin\DashboardController::class, 'load_business_state'])->name('admin.load_business_state');
    Route::post('/load_business_city', [Admin\DashboardController::class, 'load_business_city'])->name('admin.load_business_city');
    Route::get('/jobs/viewjob', [Admin\DashboardController::class, 'viewjob'])->name('admin.viewjob');

    //rounds
    Route::post('/load_round', [Admin\DashboardController::class, 'load_round'])->name('admin.load_round');

    Route::get('/interview_objectives', [Admin\InterviewObjectivesController::class, 'index'])->name('admin.interview_objectives');

    Route::get('/interview_objectives/add', [Admin\InterviewObjectivesController::class, 'add'])->name('admin.add_interview_objectives');
    Route::get('/interview_objectives/edit/{id}', [Admin\InterviewObjectivesController::class, 'edit'])->name('admin.edit_interview_objectives');
    Route::get('/interview_objectives/view/{id}', [Admin\InterviewObjectivesController::class, 'view'])->name('admin.view_interview_objectives');
    Route::post('/interview_objectives/store_objective', [Admin\InterviewObjectivesController::class, 'store'])->name('admin.store_interview_objectives');
    
    Route::post('/interview_objectives/update_objective/{id}', [Admin\InterviewObjectivesController::class, 'update'])->name('admin.update_interview_objectives');
    
    Route::get('/interview_objectives/delete_objective/{id}', [Admin\InterviewObjectivesController::class, 'delete'])->name('admin.delete_interview_objectives');
    //Questions
    Route::get('/interview_objectives/list_question/{id}/{round}', [Admin\InterviewObjectivesController::class, 'list_question'])->name('admin.list_question');
   
    Route::post('/interview_objectives/store_question', [Admin\InterviewObjectivesController::class, 'store_question'])->name('admin.store_interview_question');
    Route::get('/interview_objectives/edit_question/{id}', [Admin\InterviewObjectivesController::class, 'edit_question'])->name('admin.edit_question');
    Route::post('/interview_objectives/update_question/{id}', [Admin\InterviewObjectivesController::class, 'update_question'])->name('admin.update_question');
    Route::get('/interview_objectives/delete_question/{id}', [Admin\InterviewObjectivesController::class, 'delete_question'])->name('admin.delete_question');

    Route::get('/interview_objectives/questions/{id}', [Admin\InterviewObjectivesController::class, 'question'])->name('admin.question_interview_objectives');



    Route::get('/jobs/publish/{id}', [Admin\JobController::class, 'publish'])->name('admin.publish_jobs');

    Route::get('/question_banks', [Admin\QuestionBankController::class, 'index'])->name('admin.question_banks');

    Route::get('/question_bank/add', [Admin\QuestionBankController::class, 'add'])->name('admin.add_question_bank');
    
    Route::get('/question_bank/edit/{id}', [Admin\QuestionBankController::class, 'edit'])->name('admin.edit_question_bank');

    // Route::get('/interview_objectives/view/{id}', [Admin\QuestionBankController::class, 'view'])->name('admin.view_interview_objectives');


    Route::post('/question_bank/store_question_bank', [Admin\QuestionBankController::class, 'store'])->name('admin.store_question_bank');
    
    Route::post('/question_bank/update_question_bank/{id}', [Admin\QuestionBankController::class, 'update'])->name('admin.update_question_bank');
    
    Route::get('/question_bank/delete_question_bank/{id}', [Admin\QuestionBankController::class, 'delete'])->name('admin.delete_question_bank');

    // Interview Rounds
    Route::get('/interview_rounds', [Admin\InterviewRoundsController::class, 'index'])->name('admin.interview_rounds');
    Route::get('/interview_rounds/add', [Admin\InterviewRoundsController::class, 'add'])->name('admin.interview_rounds.add');
    Route::post('/interview_rounds/store', [Admin\InterviewRoundsController::class, 'store'])->name('admin.interview_rounds.store');
    Route::post('/interview_rounds/questions', [Admin\InterviewRoundsController::class, 'questions'])->name('admin.interview_rounds.questions');
    Route::post('/interview_rounds/questions_update', [Admin\InterviewRoundsController::class, 'questions_update'])->name('admin.interview_rounds.questions_update');
    Route::get('/interview_rounds/delete/{id}', [Admin\InterviewRoundsController::class, 'delete'])->name('admin.interview_rounds.delete');
    Route::get('/interview_rounds/edit/{id}', [Admin\InterviewRoundsController::class, 'edit'])->name('admin.interview_rounds.edit');
    Route::post('/interview_rounds/update', [Admin\InterviewRoundsController::class, 'update'])->name('admin.interview_rounds.update');
    Route::get('/interview_rounds/questions_list/{id}', [Admin\InterviewRoundsController::class, 'questions_list'])->name('admin.interview_rounds.questions_list');
    // Rounds
    Route::get('/rounds', [Admin\RoundsController::class, 'index'])->name('admin.rounds');
    Route::get('/rounds/add', [Admin\RoundsController::class, 'add'])->name('admin.rounds.add');
    Route::post('/rounds/store', [Admin\RoundsController::class, 'store'])->name('admin.rounds.store');
    Route::post('/rounds/edit', [Admin\RoundsController::class, 'edit'])->name('admin.rounds.edit');
    Route::post('/rounds/update', [Admin\RoundsController::class, 'update'])->name('admin.rounds.update');
    Route::get('/rounds/delete/{id}', [Admin\RoundsController::class, 'delete'])->name('admin.rounds.delete');
    // Job Applications
    Route::get('jobapplications',[Admin\JobapplicationsController::class,'index'])->name('admin.jobapplications');
    Route::get('jobapplications/view/{id}',[Admin\JobapplicationsController::class,'view'])->name('admin.jobapplications.view');
    Route::post('jobapplications/attemquestion',[Admin\JobapplicationsController::class,'attemquestion'])->name('admin.jobapplications.attemquestion');
    Route::post('jobapplications/assign',[Admin\JobapplicationsController::class,'assign'])->name('admin.jobapplications.assign');


    Route::post('/load_interview_round', [Admin\DashboardController::class, 'load_interview_round'])->name('admin.load_interview_round');


    Route::post('/load_interview_round_for_hr', [Admin\JobController::class, 'load_interview_round_for_hr'])->name('admin.load_interview_round_for_hr');


    Route::get('/calendar',[Admin\CalendarController::class,'index'])->name('admin.calendar');
    Route::get('/load_task',[Admin\CalendarController::class,'load_task'])->name('admin.load_task');
    Route::post('/store_data',[Admin\CalendarController::class,'store_data'])->name('admin.calender.store_data');
    Route::post('/update_data',[Admin\CalendarController::class,'update_data'])->name('admin.calender.update_data');
    Route::get('/delete_task',[Admin\CalendarController::class,'delete_task'])->name('admin.calender.delete_task');


});

