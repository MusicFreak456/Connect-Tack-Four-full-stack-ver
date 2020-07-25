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


Route::middleware('auth:sanctum')->put('/api/profile/{user}','ProfileController@update')->name('profile.update');
Route::get('/api/profile/{profile}','ProfileController@show')->name('profile.show');
Route::get('/api/user/{user}','UserController@show')->name('user.show');

Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::post('/register', 'Auth\RegisterController@register');

Route::get('/', 'HomeController@index')->name('home');
Route::middleware('auth:sanctum')->get('/profile/{id}','HomeController@index');
Route::middleware('auth:sanctum')->get('/profile/{id}/edit','HomeController@index');

Route::get('/{catch_all}', 'HomeController@index')->name('home');
