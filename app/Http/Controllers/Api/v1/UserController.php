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
}
