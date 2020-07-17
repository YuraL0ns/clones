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
Route::post('project/{project_id}/storeTask', 'ProjectController@storeTask');
Route::get('project/{project_id}/task/{task_id}/done', 'ProjectController@taskDone')->name('taskDone');
Route::post('project/{project_id}/task/{task_id}/addFile', 'ProjectController@taskAddFile')->name('taskAddFile');
Route::get('project/{project_id}/task/{task_id}/downloadFile/{file_id}', 'ProjectController@downloadTaskFile')->name('downloadTaskFile');
Route::post('project/{project_id}/task/{task_id}/editTaskSklads', 'ProjectController@editTaskSklads')->name('editTaskSklads');

Route::group(['prefix' => 'kh-admin', 'middleware' => ['role:Администратор|Директор'], 'namespace' => 'Admin'], function () {
    Route::get('dashboard', 'AccountController@dashboard')->name('admin.dashboard.main');

    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('users', 'UserController');
    Route::resource('projects', 'ProjectController');
    Route::resource('sklad', 'SkladController');
    Route::resource('contragent', 'ContragentController');

    Route::get('download/{name}/{project}', 'ProjectController@downloadFile')->name('admin.download');
    Route::post('add-file/{project}', 'ProjectController@uploadFile')->name('admin.add.file');
});

Route::group(['prefix' => 'kh-admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'AuthController@adminLoginForm')->name('admin.login.form');
    Route::post('/', 'AuthController@adminLogin')->name('admin.login');
});
