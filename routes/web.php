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

/*
 * ____ CONTACT ___________________
 *

Les routes du formulaire de contact
__________________________________
*/


Route::get('contact',
    ['as' => 'contact', 'uses' => 'ContactController@index']);
Route::post('contact',
    ['as' => 'contact_store', 'uses' => 'ContactController@store']);

/* USERS */

Route::get('user/{id}', 'UserController@show');


Route::get('recettes',
    ['as' => 'recettes_index', 'uses' => 'RecetteController@index']);

Route::get('recette/ajouter',
    ['as' => 'recettes_ajouter', 'uses' => 'RecetteController@create']);

Route::post('recette/ajouter',
    [ 'uses' => 'RecetteController@store']);



