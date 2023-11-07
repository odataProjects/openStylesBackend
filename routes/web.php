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

/* item routes */ 
Route::get("api/matiere", "App\Http\Controllers\MatiereController@readAll");
Route::post("api/matiere/search", "App\Http\Controllers\MatiereController@search");  
Route::post("api/matiere/create", "App\Http\Controllers\MatiereController@create"); 
Route::delete("api/matiere/delete", "App\Http\Controllers\MatiereController@delete"); 
Route::match(["put", "post"],"api/matiere/update", "App\Http\Controllers\MatiereController@update"); 
Route::match(["put", "post"],"api/matiere/increase", "App\Http\Controllers\MatiereController@increaseQuantity"); 
Route::match(["put", "post"],"api/matiere/decrease", "App\Http\Controllers\MatiereController@decreaseQuantity"); 
Route::match(["post"],"api/matiere/data", "App\Http\Controllers\MatiereController@getData"); 
Route::match(["get", "post"], "api/matiere/most_used", "App\Http\Controllers\MatiereController@getMostUsed"); 
Route::match(["get", "post"], "api/matiere/sold_out", "App\Http\Controllers\MatiereController@getSoldOut"); 

/* entry's history */ 
Route::get("api/entree", "App\Http\Controllers\EntreeController@readAll");
Route::get("api/entree/page", "App\Http\Controllers\EntreeController@readPage");
Route::post("api/entree/create", "App\Http\Controllers\EntreeController@create");  
Route::post("api/entree/search", "App\Http\Controllers\EntreeController@search"); 
Route::match(['post', 'get'], "api/entree/count", "App\Http\Controllers\EntreeController@getCount"); 
Route::post("api/entree/search/date", "App\Http\Controllers\EntreeController@searchByDate"); 
Route::post("api/entree/search/date_keyword", "App\Http\Controllers\EntreeController@searchByDateAndKeyword"); 
Route::delete("api/entree/delete", "App\Http\Controllers\EntreeController@delete"); 

/* sortie's history */ 
Route::get("api/sortie", "App\Http\Controllers\SortieController@readAll");
Route::post("api/sortie/create", "App\Http\Controllers\SortieController@create");  
Route::post("api/sortie/search", "App\Http\Controllers\SortieController@search"); 
Route::match(['post', 'get'], "api/sortie/count", "App\Http\Controllers\SortieController@getCount"); 
Route::post("api/sortie/search/date", "App\Http\Controllers\SortieController@searchByDate"); 
Route::post("api/sortie/search/date_keyword", "App\Http\Controllers\SortieController@searchByDateAndKeyword");  
Route::delete("api/sortie/delete", "App\Http\Controllers\SortieController@delete"); 