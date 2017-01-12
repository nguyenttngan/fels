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

        Route::get('/words', 'Web\WordsController@index');

        Route::get('/categories', 'Web\CategoriesController@index');

        Route::get('/lessons', 'Web\LessonsController@index');
        Route::get('/lessons/show/{lessonId}', 'Web\LessonsController@show');
        Route::get('/lessons/create/{categoryId}/{lessonId?}/{count?}', 'Web\LessonsController@create');
        Route::post('/lessons/update', 'Web\LessonsController@update');

        Route::post('/follows/{user}', 'Web\FollowsController@follow')->name('follows');
        Route::get('/follows/{user}', 'Web\FollowsController@show');
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
        Route::get('/home', 'Admin\HomeController@index');
        Route::resource('/categories', 'Admin\CategoryController');
        Route::resource('/users', 'Admin\UsersController');
        Route::resource('/words', 'Admin\WordsController');
    });

    Route::get('/users/show/{user?}', 'Web\UsersController@show');
    Route::get('/users/edit', 'Web\UsersController@edit');
    Route::resource('user', 'Web\UsersController', ['only' => [
        'update'
    ]]);
});
Route::get('social/redirect/{provider}', 'Auth\SocialAuthController@redirect');
Route::get('social/handle/{provider}', 'Auth\SocialAuthController@handle');
