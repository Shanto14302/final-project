<?php

use App\Http\Controllers\Spark\Api\ContactController;
use App\Http\Controllers\Spark\Api\MainSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/spark')->group(function(){
    Route::controller(ContactController::class)->group(function(){
        Route::get('contact-info','GetContactInfo');
    });

    Route::controller(MainSlider::class)->group(function(){
        Route::get('/spark-main-slider','SparkMainSlider');
    });
});
