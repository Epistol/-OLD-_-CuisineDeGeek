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

Route::get('/home', 'HomeController@index');

Route::get('contact',
    ['as' => 'contact', 'uses' => 'ModulesController@create']);
Route::post('contact',
    ['as' => 'contact_store', 'uses' => 'ModulesController@store']);

Route::get('recettes',
    ['as' => 'recettes_index', 'uses' => 'RecetteController@index']);



