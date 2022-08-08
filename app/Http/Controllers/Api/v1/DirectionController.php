<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DirectionResources;
use App\Models\Direction;

class DirectionController extends Controller
{
    
    public function index()
    {

        $direction = Direction::get();

        return  DirectionResources::collection($direction);
     
    }
}
