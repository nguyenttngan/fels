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
    Route::get('/home', 'Web\HomeController@index');
    Route::get('/word', 'Web\WordsController@index');
    Route::get('/categories', 'Web\CategoriesController@index');
    Route::get('/lessons/create/{categoryId}/{lessonId?}/{count?}', 'Web\LessonsController@create');
    Route::get('/user/show/{user?}/{count?}', 'Web\UsersController@show');
    Route::resource('user', 'Web\UsersController', ['only' => [
        'edit', 'update'
    ]]);
    Route::post('/lessons/update', 'Web\LessonsController@update');
});
