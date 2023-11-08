<?php

use App\Http\Controllers\Dashboard\UserController;



        Route::group(
            ['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

            Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){
            Route::get('/',[App\Http\Controllers\Dashboard\WelcomeController::class, 'index'])->name('welcome');
             //user controller
            Route::resource('/users',UserController::class)->except(['show']);
            Route::post('/user/profile/update', 'UserController@updateProfile')->name('user_profile_update');

            Route::get('/profile', [App\Http\Controllers\Dashboard\UserController::class, 'showProfile'])->name('profile');
            Route::post('/user_profile_update', [App\Http\Controllers\Dashboard\UserController::class, 'user_profile_update'])->name('user_profile_update');


            });
        });

