<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ForgetPasswordController;
use App\Http\Controllers\Admin\Profile\AdminProfileController;
use App\Http\Controllers\Admin\User\LogoController;
use App\Http\Controllers\Admin\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
        return view('welcome');
})->name('login')->middleware('checkloggedin');

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
});

Route::controller(LogoController::class)->middleware('auth','status_check','afpm')->prefix('admin')->group(function(){
    Route::get('/logo','GetLogo')->name('logo');

});




//admin section end


//access

Route::get('/access-denied-admin',function(){
    return view('access.access_denied');
})->name('access_denied_admin');
