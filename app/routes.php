<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get    ('/login',						'HomeController@showLogin');
Route::get    ('/dashboard',					'HomeController@showDashboard');
Route::get    ('/',								'HomeController@showHome');

Route::post   ('/login',						'UserController@login');
Route::get    ('/logout',						'UserController@logout');

Route::get 	  ('/surat/create',					'SuratController@showCreate');
Route::post   ('/surat/create',					'SuratController@create');
Route::get 	  ('/surat/update',					'SuratController@showUpdate');
Route::post   ('/surat/update',					'SuratController@update');
Route::get 	  ('/surat/edit',					'SuratController@showEdit');
Route::post   ('/surat/edit',					'SuratController@edit');
Route::get 	  ('/surat/finalize',				'SuratController@showFinalize');
Route::post   ('/surat/finalize',				'SuratController@finalize');
