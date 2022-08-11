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


    public function store(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required',
        ]);
      
        $direction = Direction::create([
            'name' => $request->name,
        ]);
       
        return response($direction, 201);
    }


    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'name' => 'required',
        ]);

        $direction = Direction::find($id); 

        $direction->update([
            'name' => $request->name,
        ]);

        return response($direction, 201);
    }

   
    public function destroy($id)
    {

        $direction = Direction::find($id); 

        $direction->delete();

        return response($direction, 201);
    }
}
