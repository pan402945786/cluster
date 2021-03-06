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

Route::get('/cluster', 'ClusterController@index');
Route::get('/', 'BigdataController@index');
Route::any('/query', 'BigdataController@query');
Route::any('/upload', 'BigdataController@upload');

//Route::get('/', function () {
//    return view('welcome');
//});
