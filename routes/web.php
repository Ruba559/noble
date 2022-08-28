<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SocialiteController;
use App\Events\NotificationEvent;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\UserOtp;
use App\Models\UserEmail;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes(['verify' => true , 'reset' => false]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth' , 'verified'])->name('dashboard');

 require __DIR__.'/auth.php';

 Route::get('verfiy_phone', [AuthenticatedSessionController::class,'getVerifyPhone']);
 Route::post('verfiy_phone', [AuthenticatedSessionController::class,'verifyPhone'])->name('verifyPhone');
 
 Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth', [SocialiteController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [SocialiteController::class, 'callbackFromFacebook'])->name('callback');
});

Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle']);
Route::get('callback/google', [SocialiteController::class, 'handleCallback']);

Route::get('/test', function () {
   $user =   UserEmail::create([
    'name'=> 'hussam',
    'email'=> 'hussam@gmail.com',
    'password'=>Hash::make('12456789') ,
    'mobile_number'=>"1231231564",

   ]);
   return $user;
});

Route::get('/Privacy', function () {
    return 'Privacy';
});
Route::get('/Terms', function () {
    return 'Terms';
});

Route::post('/search', [SearchController::class,'Search'])->name('search');
Route::post('/advanc_search', [SearchController::class,'AdvancSearch'])->name('advanc_search');
Route::get('/getNear', [SearchController::class,'getNear']);


Route::get('/language/{locale}', [LocaleController::class,'switch'])->name('switchlang');


