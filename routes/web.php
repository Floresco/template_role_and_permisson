<?php

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

Route::group([
    'middleware' => 'guest'
], function () {
    Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLogin')->name('login');
    Route::post('/login', '\App\Http\Controllers\Auth\LoginController@doLogin')->name('do-login');
    Route::get('/forget-password', \App\Http\Controllers\ForgetPasswordController::class)->name('forget-password');
    Route::post('/forget-password', \App\Http\Controllers\ForgetPasswordController::class)->name('forget-password');
});


Route::group([
    'middleware' => ['auth:web']
], function () {
    Route::post('/logout', \App\Http\Controllers\LogoutController::class)->name('logout');
    Route::get('/', \App\Http\Controllers\DashboardController::class)->name('dashboard');

    Route::get('/tasks', \App\Http\Controllers\DashboardController::class)->name('tasks');

    Route::prefix('/settings')->as('settings.')->group(function () {
        Route::get('/analytics', \App\Http\Controllers\DashboardController::class)->name('analytics');
        Route::get('/e-commerce', \App\Http\Controllers\DashboardController::class)->name('e-commerce');
    });

    Route::prefix('user_management')->as('user_management.')->group(function () {
        Route::group([
            'prefix' => 'users',
            'as' => 'users.'
        ], function () {
            Route::get('/', 'App\Http\Controllers\UserController@index')->name('index');
            Route::get('/add','App\Http\Controllers\UserController@create')->name('create');
            Route::post('/add','App\Http\Controllers\UserController@store')->name('store');
            Route::get('/show/{user}','App\Http\Controllers\UserController@show')->name('show');
            Route::get('/edit/{user}','App\Http\Controllers\UserController@edit')->name('edit');
            Route::post('/update/{user}','App\Http\Controllers\UserController@update')->name('update');
            Route::delete('/delete/{user}','App\Http\Controllers\UserController@destroy')->name('destroy');
        });

        Route::group([
            'prefix' => 'roles',
            'as' => 'roles.'
        ], function () {
            Route::get('/', 'App\Http\Controllers\RoleController@index')->name('index');
            Route::get('/add','App\Http\Controllers\RoleController@create')->name('create');
            Route::post('/add','App\Http\Controllers\RoleController@store')->name('store');
            Route::get('/show/{role}','App\Http\Controllers\RoleController@show')->name('show');
            Route::get('/edit/{role}','App\Http\Controllers\RoleController@edit')->name('edit');
            Route::post('/update/{role}','App\Http\Controllers\RoleController@update')->name('update');
            Route::delete('/delete/{role}','App\Http\Controllers\RoleController@destroy')->name('destroy');

        });


    });
});

