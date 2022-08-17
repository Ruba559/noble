<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResources;
use App\Models\User;

class UserController extends Controller
{
   
    public function index()
    {

        $user = User::get();

        return  UserResources::collection($user);
     
    }


    public function store(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'long' => 'nullable',
            'lat' => 'nullable',
        ]);
      
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => '0',
            'fcm_token' => 'token',
            'long' => $request->long,
            'lat' => $request->lat,
            'slug' =>  $this->slug($request->name),
        ]);

       
        return response($user, 201);
    }


    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'long' => 'nullable',
            'lat' => 'nullable',
        ]);

        $user = User::find($id); 

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => '0',
            'fcm_token' => 'token',
            'long' => $request->long,
            'lat' => $request->lat,
            'slug' =>  $this->slug($request->name),
        ]);

        return response($user, 201);
    }

   
    public function destroy($id)
    {

        $user = User::find($id); 

        $user->delete();

        return response($user, 201);
    }

    public function slug($string, $separator = '-')
    {
        if (is_null($string)) {
            return "";
        }
    
        $string = trim($string);
        $string = mb_strtolower($string, "UTF-8");;
        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", $separator, $string);
    
        return $string;
    }
}
