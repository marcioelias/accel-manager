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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
/* 
Route::get('/', 'HomeController@index')->name('home'); */
Route::middleware(['auth:web'])->group(function() {

    Route::get('/', 'HomeController@index')->name('home');
    /* Route::get('/', 'DashboardController@index')->name('home'); */

    Route::get('/perfil', 'UserController@profile')->name('user.profile');
    Route::get('/alterar_senha', 'UserController@showChangePassword')->name('user.form.change.password');
    Route::put('/alterar_senha/{user}', 'UserController@changePassword')->name('user.change.password');

    Route::resource('/role_user', 'RoleUsersController')->except('show');
    Route::resource('/role', 'RolesController')->except('show');
    Route::resource('/user', 'UserController')->except('show');
    Route::resource('/concentrador', 'ConcentradorController')->except('show');


    Route::get('/sessions/columns', 'ColumnController@getColumns')->name('sesssions.columns');
    Route::get('/sessions', 'AccelController@getSessions')->name('sessions.raw');
    Route::get('/sessions/json', 'AccelController@getSessionsJson')->name('sessions.json');
    Route::get('/interface/{ifname}/json', 'AccelController@getInterfaceStats');

    Route::post('/session/drop', 'AccelController@dropSession');
    Route::post('/session/queue', 'AccelController@changeQueue');
});
