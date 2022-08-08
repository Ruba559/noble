<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CladdingResources;
use App\Models\Cladding;

class CladdingController extends Controller
{
   
    public function index()
    {

        $cladding = Cladding::get();

        return  CladdingResources::collection($cladding);
     
    }
}
