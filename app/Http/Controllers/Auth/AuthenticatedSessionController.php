<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OTP;
use App\Models\UserOtp;
use App\Models\UserEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
   
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        
      if($request->verify_code)
      {
        OTP::create([
          'mobile_number' => $request->mobile_number,
          'code' => random_int(100000, 999999), 
          ]);
  
           session(['mobile_number' =>  $request->mobile_number]);
  
          return redirect('verfiy_phone');
  
      
          // $request->authenticate();
          // $request->session()->regenerate();
          // $user = UserEmail::where('mobile_number' , $request->mobile_number)->first();
          // Auth::login($user);

          return redirect()->intended(RouteServiceProvider::HOME);
      }

    }


    public function getVerifyPhone()
    {

        return view('auth.verify-phone');
    }

    public function VerifyPhone(Request $request)
    {

        $fields = $request->validate([
            'code' => 'required|min:0|max:6',
        ]);

        $otp = OTP::where('code' , $request->code)->first();

       if($otp)
       {
          if(session('mobile_number')){

            $user = UserOtp::where('mobile_number' , session('mobile_number'))->first();
            if($user)
            {
              Auth::login($user);
              $user->update([
                'email_verified_at' => Carbon::now()->timestamp,
               ]);
              return redirect()->intended(RouteServiceProvider::HOME);

            }else{
              $user = UserOtp::create([
            'name' => session('name'),
            'email' => session('email'),
            'password' => Hash::make(session('password')),
            'mobile_number' => session('mobile_number'),
            'email_verified_at' => Carbon::now()->timestamp,
            ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
            }
       }else{
        return 'false';
       }
      }else{
        return 'false';
      }
    
       
       }

  
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
