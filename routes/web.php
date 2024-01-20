<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ForgetPasswordController;
use App\Http\Controllers\Admin\Profile\AdminProfileController;
use App\Http\Controllers\Admin\User\LogoController;
use App\Http\Controllers\Admin\User\StudentController;
use App\Http\Controllers\Admin\User\TeacherController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Supervisor\DefenseController;
use App\Http\Controllers\Supervisor\SupervisorChoice;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/pmis-login', function () {
        return view('welcome');
})->name('login')->middleware('checkloggedin');
Route::get('/', function () {
    return view('welcome_page');
});
// Auth::routes();

Route::get('/admin-dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('status_check');

//admin section

Route::controller(LoginController::class)->group(function(){
    Route::prefix('admin')->group(function(){
        Route::post('/login','Login')->name('admin_login');
        Route::middleware('auth')->group(function(){
            //admin logout
            Route::get('/logout','Logout')->name('admin_logout');



        });
    });
});

//forget password
Route::controller(ForgetPasswordController::class)->group(function(){
    Route::prefix('admin')->group(function(){
        Route::middleware('checkloggedin')->group(function(){
            Route::get('/forgot-password','ForgotPassword')->name('admin_forgot_password');
            Route::post('/forgot-password','ForgotPasswordMail')->name('admin_forgot_password');
        });
        Route::middleware(['auth','afpm','status_check'])->group(function(){
            //reset requests
            Route::get('/reset-requests','ResetRequests')->name('reset_request');


            //json dependency
            Route::post('/reset-requests-data','ResetRequestsData');
            Route::get('/reset-requests-data-update/{id}','ResetRequestsDataUpdate');
        });
    });

    Route::middleware('checkloggedin')->group(function(){
        Route::get('/reset-password/{token}','ResetPasswordForm')->name('reset_password');
        Route::post('/reset-password-confirm','ResetPassword')->name('reset_password_confirm');
    });
});

//admin profile
Route::controller(AdminProfileController::class)->group(function(){
    Route::prefix('admin')->group(function(){
        Route::middleware('auth','status_check')->group(function(){
            Route::get('/profile','AdminProfile')->name('admin_profile');
            Route::post('/profile','AdminProfileUpdate')->name('admin_profile');
            Route::post('/update-basic-info','UpdateBasicInfo')->name('update_basic_info');
            Route::post('/update-additional-info','UpdateAdditionalInfo')->name('update_additional_info');
            Route::post('/update-image-info','UpdateImageInfo')->name('update_image_info');
            Route::post('/update-password','UpdatePassword')->name('update_password');



        });
    });
});


//admin users crud

Route::controller(UserController::class)->middleware('auth','status_check','afpm')->prefix('admin')->group(function(){
    Route::get('/view-users','ViewUsers')->name('view_users');
    Route::post('/search-admin','SearchAdmin')->name('search_admin');
    Route::get('/update-user-status/{id}','UpdateUserStaus')->name('update_user_status');
    Route::get('/get-user-information/{id}','GetUserInfo');
    Route::post('/update-basic-info-user','UpdateBasicInfo')->name('update_basic_info_user');
    Route::post('/update-additional-info-user','UpdateAdditionalInfo')->name('update_additional_info_user');
    Route::get('/delete-user/{id}','DeleteUser');
    Route::post('/send-mail-user','MailToUser');
    Route::post('/add-user','AddUser');

    //edit status
    Route::get('/update-user-basic-edit-status/{id}','EditBasicStaus');
    Route::get('/update-user-additional-edit-status/{id}','EditAdditionalStaus');
});

Route::controller(LogoController::class)->middleware('auth','status_check','afpm')->prefix('admin')->group(function(){
    Route::get('/logo','GetLogo')->name('logo');
    Route::post('/upload-logo','UploadLogo')->name('upload_logo');
    Route::post('/search-logo','SearchLogo')->name('search_logo');
    Route::get('/logo-status-change/{id}','LogoStatusChange');
    Route::get('/delete-logo/{id}','DeleteLogo');

});

Route::controller(TeacherController::class)->middleware('auth','status_check','afpm')->prefix('admin')->group(function(){
    Route::get('/teachers','GetTeacher')->name('teachers');
    Route::post('/add-teacher','AddTeacher');
    Route::post('/search-teacher','SearchTeacher')->name('search_teacher');
    Route::get('/update-teacher-status/{id}','UpdateTeacherStaus')->name('update_teacher_status');
    Route::get('/get-teacher-information/{id}','GetTeacherInfo');
    Route::post('/update-basic-info-teacher','UpdateBasicInfo')->name('update_basic_info_teacher');
    Route::get('/delete-teacher/{id}','DeleteTeacher');
    Route::post('/send-mail-teacher','MailToTeacher');
});


Route::controller(StudentController::class)->middleware('auth','status_check','afpm')->prefix('admin')->group(function(){
    Route::get('/students','GetStudent')->name('students');
    Route::post('/add-student','AddStudent');
    Route::post('/search-student','SearchStudent')->name('search_student');
    Route::get('/update-student-status/{id}','UpdateStudentStaus')->name('update_student_status');
    Route::get('/get-student-information/{id}','GetStudentInfo');
    Route::post('/update-basic-info-student','UpdateBasicInfo')->name('update_basic_info_student');
    Route::get('/delete-student/{id}','DeleteStudent');
    Route::post('/send-mail-student','MailToStudent');
});

Route::controller(SupervisorChoice::class)->middleware('auth','status_check','student')->prefix('student')->group(function(){
    Route::get('/supervisor-choice','SupervisorChoice')->name('supervisor_choice');



    // json dependency
    Route::get('/get-faculty-teacher/{faculty}','GetFacultyTeacher');
    Route::post('/supervisor-choice','SupervisorChoiceInsert');
    Route::post('/cosupervisor-choice','CosupervisorChoiceInsert');

});

Route::controller(SupervisorChoice::class)->middleware('auth','status_check','afpm')->prefix('admin')->group(function(){
    Route::get('/supervisor-choice-request','SupervisorChoiceRequests')->name('supervisor_choice_request');
    Route::post('/supervisor-choice-request','SupervisorChoiceRequestsUpdate')->name('supervisor_choice_request');
    Route::get('/delete-supervisor/{id}','DeleteSupervisor')->name('delete_supervisor');
    Route::get('/view-result-admin','Viewresult')->name('view_result_admin');
});


Route::controller(DefenseController::class)->middleware('auth','status_check','teacher')->prefix('teacher')->group(function(){
    Route::get('/initial-phase','InitialPhase')->name('initial_phase');
    Route::post('/initial-phase','InitialPhaseInsert')->name('initial_phase');
    Route::get('/title-defense','TitleDefense')->name('title_defense');
    Route::post('/title-defense','TitleDefenseInsert')->name('title_defense');
    Route::post('/update-title-defense','TitleDefenseUpdate')->name('update_title_defense');
    Route::post('/update-title-defense-status','TitleDefenseStatusUpdate')->name('update_title_defense_status');
    Route::get('/pre-defense','PreDefense')->name('pre_defense');
    Route::post('/pre-defense','PreDefenseInsert')->name('pre_defense');
    Route::post('/update-pre-defense','PreDefenseUpdate')->name('update_pre_defense');
    Route::post('/update-pre-defense-status','PreDefenseStatusUpdate')->name('update_pre_defense_status');
    Route::get('/final-defense','FinalDefense')->name('final_defense');
    Route::post('/final-defense','FinalDefenseInsert')->name('final_defense');
    Route::post('/update-final-defense','FinalDefenseUpdate')->name('update_final_defense');
    Route::get('/publish-final-result/{phase_id}','PublishFinalResult')->name('publish_final_result');
    Route::get('/view-result','Viewresult')->name('view_result');
});

Route::controller(DefenseController::class)->middleware('auth','status_check','student')->prefix('student')->group(function(){
    Route::get('/attemp-title-defense','AttempTitleDefense')->name('attemp_title_defense');
    Route::post('/attemp-title-defense','AttempTitleDefenseInsert')->name('attemp_title_defense');
    Route::get('/attemp-pre-defense','AttempPreDefense')->name('attemp_pre_defense');
    Route::post('/attemp-pre-defense','AttempPreDefenseInsert')->name('attemp_pre_defense');
    Route::get('/attemp-final-defense','AttempFinalDefense')->name('attemp_final_defense');
    Route::post('/attemp-final-defense','AttempFinalDefenseInsert')->name('attemp_final_defense');
});

//admin section end





//access

Route::middleware('auth')->get('/access-denied-admin',function(){
    return view('access.access_denied');
})->name('access_denied_admin');


