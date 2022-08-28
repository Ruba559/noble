<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\OTP;
use App\Models\UserEmail;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
   
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'mobile_number' => [ 'min:0' , 'max:10' , 'starts_with:09'],
        ]);

        if($request->verify_code)
        {
        OTP::create([
            'mobile_number' => $request->mobile_number,
            'code' => random_int(100000, 999999), 
            ]);
    
             session(['mobile_number' =>  $request->mobile_number,
                      'name' =>  $request->name ,
                      'email' =>  $request->email ,
                      'password' => $request->password,
            ]);
    
            return redirect('verfiy_phone');
        }else
        if($request->verify_email)
        {

        $user = UserEmail::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile_number' => $request->mobile_number,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
        }
    }
}
