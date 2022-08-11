<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\ArticleController;
use App\Http\Controllers\Api\v1\CladdingController;
use App\Http\Controllers\Api\v1\PropertyController;
use App\Http\Controllers\Api\v1\PropertyTypeController;
use App\Http\Controllers\Api\v1\ComplaintController;
use App\Http\Controllers\Api\v1\PlaceController;
use App\Http\Controllers\Api\v1\DirectionController;
use App\Http\Controllers\Api\v1\CityController;
use App\Http\Controllers\Api\v1\FavoriteController;
use App\Http\Controllers\Api\v1\BackNotificationController;
use App\Http\Controllers\Api\v1\AuthController;


Route::get('/', function () {
    return view('welcome');
});

Route::post('login', [AuthController::class ,'login']);
Route::post('register', [AuthController::class ,'register']);

Route::group(['middleware' => ['auth:sanctum' , 'CheckRole']], function () {

    Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/user', [UserController::class,'index']);
Route::post('/user', [UserController::class,'store']);
Route::post('/user/{id}', [UserController::class,'update']);
Route::delete('/user/{id}', [UserController::class,'destroy']);

Route::get('/article', [ArticleController::class,'index']);
Route::post('/article', [ArticleController::class,'store']);
Route::post('/article/{id}', [ArticleController::class,'update']);
Route::delete('/article/{id}', [ArticleController::class,'destroy']);

Route::get('/cladding', [CladdingController::class,'index']);
Route::post('/cladding', [CladdingController::class,'store']);
Route::post('/cladding/{id}', [CladdingController::class,'update']);
Route::delete('/cladding/{id}', [CladdingController::class,'destroy']);

Route::get('/property', [PropertyController::class,'index']);
Route::post('/property', [PropertyController::class,'store']);
Route::post('/property/{id}', [PropertyController::class,'update']);
Route::delete('/property/{id}', [PropertyController::class,'destroy']);

Route::get('/propertyType', [PropertyTypeController::class,'index']);
Route::post('/propertyType', [PropertyTypeController::class,'store']);
Route::post('/propertyType/{id}', [PropertyTypeController::class,'update']);
Route::delete('/propertyType/{id}', [PropertyTypeController::class,'destroy']);

Route::get('/complaint', [ComplaintController::class,'index']);
Route::post('/complaint', [ComplaintController::class,'store']);
Route::post('/complaint/{id}', [ComplaintController::class,'update']);
Route::delete('/complaint/{id}', [ComplaintController::class,'destroy']);

Route::get('/place', [PlaceController::class,'index']);
Route::post('/place', [PlaceController::class,'store']);
Route::post('/place/{id}', [PlaceController::class,'update']);
Route::delete('/place/{id}', [PlaceController::class,'destroy']);

Route::get('/direction', [DirectionController::class,'index']);
Route::post('/direction', [DirectionController::class,'store']);
Route::post('/direction/{id}', [DirectionController::class,'update']);
Route::delete('/direction/{id}', [DirectionController::class,'destroy']);

Route::get('/city', [CityController::class,'index']);
Route::post('/city', [CityController::class,'store']);
Route::post('/city/{id}', [CityController::class,'update']);
Route::delete('/city/{id}', [CityController::class,'destroy']);

Route::get('/favorite', [FavoriteController::class,'index']);
Route::post('/favorite', [FavoriteController::class,'store']);
Route::post('/favorite/{id}', [FavoriteController::class,'update']);
Route::delete('/favorite/{id}', [FavoriteController::class,'destroy']);

Route::get('/backNotification', [BackNotificationController::class,'index']);
Route::post('/backNotification', [BackNotificationController::class,'store']);
Route::post('/backNotification/{id}', [BackNotificationController::class,'update']);
Route::delete('/backNotification/{id}', [BackNotificationController::class,'destroy']);

});