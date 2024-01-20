<?php

use App\Http\Controllers\Spark\ContactController;
use App\Http\Controllers\Spark\MainSlider;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function(){
    Route::controller(ContactController::class)->group(function(){
        Route::get('/spark-contact','SparkContact')->name('spark_contact');
        Route::post('/spark-contact','SparkContactUpdate')->name('spark_contact');
        Route::post('/spark-social','SparkSocialUpdate')->name('spark_social');
        Route::post('/spark-address','SparkAddressUpdate')->name('spark_address');
    });
    Route::controller(MainSlider::class)->group(function(){
        Route::get('/spark-main-slider','SparkMainSlider')->name('spark_main_slider');
        Route::post('/spark-main-slider-headline','SparkMainSliderHeadline')->name('spark_main_slider_headline');
        Route::post('/spark-main-slider-image','SparkMainSliderImage')->name('spark_main_slider_image');
        Route::get('/spark-main-slider-image-staus/{id}/{status}','SparkMainSliderImageStatus');
        Route::get('/spark-main-slider-image-delete/{id}','SparkMainSliderImageDelete');
    });
});

