<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\ArticleController;
use App\Http\Controllers\Api\v1\CladdingController;
use App\Http\Controllers\Api\v1\PropertyController;
use App\Http\Controllers\Api\v1\PropertyTypeController;
use App\Http\Controllers\Api\v1\ComplaintController;
use App\Http\Controllers\Api\v1\PlaceController;
use App\Http\Controllers\Api\v1\DirectionResources;
use App\Http\Controllers\Api\v1\CityController;


Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get('/user', [UserController::class,'index']);
Route::get('/Article', [ArticleController::class,'index']);
Route::get('/Cladding', [CladdingController::class,'index']);
Route::get('/Property', [PropertyController::class,'index']);
Route::get('/PropertyType', [PropertyTypeController::class,'index']);
Route::get('/Complaint', [ComplaintController::class,'index']);
Route::get('/Place', [PlaceController::class,'index']);
Route::get('/Direction', [DirectionResources::class,'index']);
Route::get('/City', [CityController::class,'index']);
