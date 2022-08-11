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
        ]);
      
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

       
        return response($user, 201);
    }


    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::find($id); 

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response($user, 201);
    }

   
    public function destroy($id)
    {

        $user = User::find($id); 

        $user->delete();

        return response($user, 201);
    }
}
