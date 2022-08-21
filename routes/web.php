<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Events\NotificationEvent;


Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes(['verify' => true]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth' , 'verified'])->name('dashboard');

 require __DIR__.'/auth.php';


Route::post('/search', [SearchController::class,'Search'])->name('search');
Route::post('/advanc_search', [SearchController::class,'AdvancSearch'])->name('advanc_search');
Route::get('/getNear', [SearchController::class,'getNear']);


Route::get('/language/{locale}', [LocaleController::class,'switch'])->name('switchlang');


