<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PropertyTypeResources;
use App\Models\PropertyType;


class PropertyTypeController extends Controller
{
  
    public function index()
    {

        $PropertyType = PropertyType::get();

        return  PropertyTypeResources::collection($PropertyType);
     
    }
}
