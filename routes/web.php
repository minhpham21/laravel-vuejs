<?php

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
    return view('welcome');
});

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    // Admin
    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['role:' . config('constants.role.admin')]
    ], function () {
        Route::get('/', function() {
            dd('This is admin page');
        });
        Route::resource('categories', 'CategoryController');
    });
    // Client
    Route::group([
        'prefix' => 'client',
        'as' => 'client.',
        'middleware' => ['role:' . config('constants.role.client')]
    ], function () {
        Route::get('/welcome', function () {
            return view('welcome');
        })->name('welcome');
    });
});
