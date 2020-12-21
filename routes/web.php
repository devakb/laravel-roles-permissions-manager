<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Route::group(['prefix'=>"admin",'as' => 'admin.','namespace' => 'App\Http\Controllers\Admin','middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('/users', 'UserController');
    Route::get('/users/{user}/photo', 'UserController@editPhoto')->name('users.photo.edit');
    Route::put('/users/{user}/photo', 'UserController@updatePhoto')->name('users.photo.update');
    Route::delete('/users/{user}/photo', 'UserController@deletePhoto')->name('users.photo.delete');

    Route::resource('/roles', 'RoleController');
    Route::resource('/permissions', 'PermissionController')->except(['show']);

});



