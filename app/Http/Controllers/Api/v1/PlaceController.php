<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PlaceResources;
use App\Models\Place;

class PlaceController extends Controller
{
    
    public function index()
    {

        $place = Place::get();

        return  PlaceResources::collection($place);
     
    }
}
