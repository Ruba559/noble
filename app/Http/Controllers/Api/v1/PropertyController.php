<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PropertyResources;
use App\Models\Property;

class PropertyController extends Controller
{
   
    public function index()
    {

        $property = Property::get();

        return  PropertyResources::collection($property);
     
    }
}
