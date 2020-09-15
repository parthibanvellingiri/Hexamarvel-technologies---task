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

Route::get('/', 'HomeController@index')->name('home');

\Illuminate\Support\Facades\Auth::routes();

Route::get('/users', 'HomeController@users')->name('users');
Route::post('/importuser', 'HomeController@usersImport')->name('usersImport');
Route::get('/adduser', 'HomeController@addUser')->name('addUser');
Route::get('/viewdwtails/{id}', 'HomeController@viewDetails')->name('viewDetails');
Route::post('/searchbyidname', 'HomeController@searchUserByIdandName')->name('searchUserByIdandName');
Route::post('/searchbybranchdesignation', 'HomeController@sortByBranchDesignation')->name('ajax.sortByBranchDesignation');
Route::post('/searchbygenderbranch', 'HomeController@filterGenderandBranch')->name('ajax.filterGenderandBranch');
