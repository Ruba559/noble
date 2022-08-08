<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CityResources;
use App\Models\City;

class CityController extends Controller
{
    
    public function index()
    {

        $city = City::get();

        return  CityResources::collection($city);
     
    }
}
