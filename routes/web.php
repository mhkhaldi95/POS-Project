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

use App\Pruduct;
use Illuminate\Support\Facades\Request;

Route::get('/','consss@index')->name('welcome');
Route::get('/admin/change/lang/{lang}',['as'=>'lang','uses'=>'POSController@change']);

Route::get('/helloTest', function (Request $request){
    return $request::server('HTTP_ACCEPT_LANGUAGE');
});


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
Route::prefix('dashboard/categories')->name('dashboard.categories.')->group(function (){
   Route::get('/index','CategoryController@index')->name('index');
//    Route::get('/users','CategoryController@users')->name('users');
    Route::post('/create','CategoryController@store')->name('create');//modal
    Route::post('/delete/{id?}','CategoryController@destroy')->name('delete');
    Route::get('/edit/{id?}','CategoryController@edit')->name('edit');
    Route::post('/update/{id?}','CategoryController@update')->name('update');
    Route::get('/createview','CategoryController@create')->name('createview');//view
});

Route::prefix('dashboard/products')->name('dashboard.products.')->group(function (){
   Route::get('/index','PruductController@index')->name('index');
    Route::get('/createview','PruductController@create')->name('create');//view
    Route::post('/store','PruductController@store')->name('store');//modal
    Route::post('/delete/{product?}','PruductController@destroy')->name('delete');
    Route::get('/edit/{product?}','PruductController@edit')->name('edit');
    Route::post('/update/{product?}','PruductController@update')->name('update');
});
Route::prefix('dashboard/clients')->name('dashboard.clients.')->group(function (){
   Route::get('/index','ClientController@index')->name('index');
    Route::get('/createview','ClientController@create')->name('create');//view
    Route::post('/store','ClientController@store')->name('store');//modal
    Route::post('/delete/{client?}','ClientController@destroy')->name('delete');
    Route::get('/edit/{client?}','ClientController@edit')->name('edit');
    Route::post('/update/{client?}','ClientController@update')->name('update');
});


