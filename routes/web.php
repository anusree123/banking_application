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



Auth::routes();


Route::get('/', 'LandingController@index');
Route::get('/home', 'HomeController@index')->middleware(['web','auth']);
Route::get('/admin-panel', 'AdminController@index')->middleware(['web','auth']);


Route::get('/deposit/create', 'DepositController@create')->middleware(['web','auth']);
Route::post('/deposit/store', 'DepositController@store')->middleware(['web','auth']);

Route::get('/withdraw/create', 'WithdrawController@create')->middleware(['web','auth']);
Route::post('/withdraw/store', 'WithdrawController@store')->middleware(['web','auth']);

Route::get('/transfer/create', 'TransferController@create')->middleware(['web','auth']);
Route::post('/transfer/store', 'TransferController@store')->middleware(['web','auth']);

Route::get('/statement/index', 'StatementController@index')->middleware(['web','auth']);


