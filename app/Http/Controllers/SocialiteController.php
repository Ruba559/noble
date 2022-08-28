<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
   
    public function loginUsingFacebook()
    {
       return Socialite::driver('facebook')->redirect();
    }
   
    public function callbackFromFacebook()
    {
     try {
          $user = Socialite::driver('facebook')->user();
   
          $saveUser = User::updateOrCreate([
              'social_id' => $user->getId(),
          ],[
              'name' => $user->getName(),
              'email' => $user->getEmail(),
              'password' => Hash::make($user->getName().'@'.$user->getId())
               ]);
   
          Auth::loginUsingId($saveUser->id);
   
          return redirect()->route('home');
          } catch (\Throwable $th) {
             throw $th;
          }
      }


      public function redirectToGoogle()
      {
          return Socialite::driver('google')->redirect();
      }
         
      /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function handleCallback()
      {
          
       
              $user = Socialite::driver('google')->user();
        
              $finduser = User::where('social_id', $user->id)->first();
        
              if($finduser){
        
                  Auth::login($finduser);
       
                  return redirect('/home');
        
              }else{
                  $newUser = User::create([
                      'name' => $user->name,
                      'email' => $user->email,
                      'social_id'=> $user->id,
                      'social_type'=> 'google',
                      'password' => encrypt('my-google')
                  ]);
       
                  Auth::login($newUser);
        
                  return redirect('/home');
              }
       
          
      }
}
