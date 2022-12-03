<?php

use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\Client\OrderController;


        Route::group(
            ['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

            Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){
            Route::get('/',[App\Http\Controllers\Dashboard\WelcomeController::class, 'index'])->name('welcome');

             //user controller
            Route::resource('/users',UserController::class)->except(['show']);

              //category controller
            Route::resource('/categories',CategoryController::class)->except(['show']);


                //products controller
            Route::resource('/products',ProductController::class)->except(['show']);


            Route::resource('/clients',ClientController::class)->except(['show']);
            Route::resource('clients.orders',OrderController::class)->except(['show']);
            });
        });
