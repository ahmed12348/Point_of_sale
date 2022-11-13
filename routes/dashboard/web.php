<?php

use App\Http\Controllers\Dashboard\UserController;
        Route::group(
            ['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

            Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){
            Route::get('/index',[App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('index');

             //user controller
            Route::resource('/users',UserController::class)->except(['show']);
            });
        });
