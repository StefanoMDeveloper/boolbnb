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

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function(){
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('/apartments','ApartmentController');
        Route::delete('images/{image}','ImageController@destroy')->name('images.destroy');
        Route::post('images/{image}','ImageController@update')->name('images.update');
        // Route::delete('messages/{message}','MessageController@destroy')->name('messages.destroy');
        Route::get('/apartmentMessages/{apartment}','MessageController@show')->name('apartmentMessages');
        Route::get('/messages','MessageController@index')->name('messages');
        Route::get('/profile','ProfileController@index')->name('profile');
        Route::get('/infoprofile','InfoprofileController@index')->name('infoprofile');
        Route::get('/stats','StatController@index')->name('stats');
        Route::get('/sponsorize/{apartment}', 'SponsorController@sponsorize')->name('sponsorize');
        Route::get('/sponsorships/store', 'SponsorController@store')->name('sponsorships.store');
    });


Route::get("{any?}", function() {
    return view("front");
})->where("any",".*");