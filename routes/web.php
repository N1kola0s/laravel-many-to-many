<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

/* Route::get('/', function () {
    return view('welcome');
}); */


Auth::routes();


Route::middleware('auth')->namespace('Admin')->name('admin.')->prefix('admin')->group(function(){
    /* Admin dashboard */
    Route::get('/', 'HomeController@index')->name('dashboard');

    /* Admin posts */
    Route::resource('posts', 'PostController');

     /* Admin categories */
    Route::resource('categories', 'CategoryController')->except(['show','create','edit']);
});


Route::get('{any?}', function(){
    return view('guest.home');

})->where('any', '.*');
