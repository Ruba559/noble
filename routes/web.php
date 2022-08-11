<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;




Route::get('/', function () {
    return view('welcome');
});
Auth::routes(['verify' => true]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth' , 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::post('/search', [SearchController::class,'Search'])->name('search');