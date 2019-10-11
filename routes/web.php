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

Route::get('/','consss@index')->name('welcome');
Route::get('/admin/change/lang/{lang}',['as'=>'lang','uses'=>'POSController@change']);


Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('dashboard')->name('dashboard.')->group(function (){
   Route::get('/test','POSController@index')->name('index');
    Route::get('/users','POSController@users')->name('users');
    Route::post('/users/create','POSController@create')->name('users.create');//modal
    Route::post('/users/delete/{id?}','POSController@delete')->name('users.delete');
    Route::post('/users/edit/{id?}','POSController@edit')->name('users.edit');
    Route::get('/users/editview/{id?}','POSController@editview')->name('users.editview');
    Route::get('/users/createe','POSController@createview')->name('users.createview');//view
});


