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
Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'user'], function() {
        Route::get('/home', 'Web\HomeController@index');

        Route::get('/word', 'Web\WordsController@index');

        Route::get('/categories', 'Web\CategoriesController@index');

        Route::get('/lessons', 'Web\LessonsController@index');
        Route::get('/lessons/show/{lessonId}', 'Web\LessonsController@show');
        Route::get('/lessons/create/{categoryId}/{lessonId?}/{count?}', 'Web\LessonsController@create');
        Route::post('/lessons/update', 'Web\LessonsController@update');

        Route::post('/follow/{user}', 'Web\FollowsController@follow')->name('follow');
    });

    Route::group(['middleware' => 'admin'], function() {
        Route::get('admin/home', 'Admin\HomeController@index');
        Route::resource('admin/categories', 'Admin\CategoryController');
    });

    Route::get('/user/show/{user?}', 'Web\UsersController@show');
    Route::get('/user/edit', 'Web\UsersController@edit');
    Route::resource('user', 'Web\UsersController', ['only' => [
        'update'
    ]]);
});
