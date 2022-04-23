<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->name('api.')->group(function () {
    Route::get("/apartments", "ApartmentController@index")->name('apartments');
    Route::get("/apartments/{slug}", "ApartmentController@show")->name('apartments.show');
    Route::get('apartments/filter/search={search}&radius={radius}&beds={beds}&rooms={rooms}&lat={lat}&lon={lon}&services={services}' , "ApartmentController@filter")->name('apartments.filter');
    Route::get("/users/{id}", "UserController@show")->name('users.show');
    Route::post("/messages", "MessagesController@store")->name('messages.store');
});
