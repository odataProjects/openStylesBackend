<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// get all apartment records 
Route::match(["get", "post"], "appartement", "App\Http\Controllers\AppartementController@all"); 
// create apartment 
Route::post("appartement/create", "App\Http\Controllers\AppartementController@create");
// update apartment 
Route::post("appartement/update", "App\Http\Controllers\AppartementController@update"); 
// delete apartment  
Route::post("appartement/delete", "App\Http\Controllers\AppartementController@delete");  
// sum of the field loyer of the apartment  
Route::match(["get", "post"], "appartement/total", "App\Http\Controllers\AppartementController@total");
// minimum of the field loyer of the apartment  
Route::match(["get", "post"], "appartement/minimum", "App\Http\Controllers\AppartementController@minimum");  
Route::match(["get", "post"], "appartement/min", "App\Http\Controllers\AppartementController@minimum");  
// maximum of the field loyer of the apartment  
Route::match(["get", "post"], "appartement/maximum", "App\Http\Controllers\AppartementController@maximum");  
Route::match(["get", "post"], "appartement/max", "App\Http\Controllers\AppartementController@maximum");    