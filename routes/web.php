<?php

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

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('dashboard', 'AccountController@dashboard')->name('user.dashboard');
    Route::resource('sklader', 'SkladController');
    Route::resource('project', 'ProjectController')->only(['show', 'index', 'create', 'store', 'update']);

    Route::get('download/{name}/{project}', 'ProjectController@downloadFile')->name('user.download');
    Route::post('add-file/{project}', 'ProjectController@uploadFile')->name('user.add.file');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::post('project/{project}/comments', 'CommentsController@store');

Route::group(['prefix' => 'kh-admin', 'middleware' => ['role:Администратор|Директор'], 'namespace' => 'Admin'], function () {
    Route::get('dashboard', 'AccountController@dashboard')->name('admin.dashboard.main');

    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('users', 'UserController');
    Route::resource('projects', 'ProjectController');
    Route::resource('sklad', 'SkladController');

    Route::get('download/{name}/{project}', 'ProjectController@downloadFile')->name('admin.download');
    Route::post('add-file/{project}', 'ProjectController@uploadFile')->name('admin.add.file');
});

Route::group(['prefix' => 'kh-admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'AuthController@adminLoginForm')->name('admin.login.form');
    Route::post('/', 'AuthController@adminLogin')->name('admin.login');
});
