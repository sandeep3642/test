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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('home/{id}', 'HomeController@destroy')->name('homeDelete');
Route::get('home/update/{id}', 'HomeController@update')->name('homeUpdate');
Route::post('home/edit', 'HomeController@edit')->name('homeedit');
Route::delete('multipleusersdelete', 'HomeController@deleteAll');  

