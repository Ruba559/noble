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


    public function store(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required',
            'city_id' => 'required',
        ]);
      
        $place = Place::create([
            'name' => $request->name,
            'city_id' => $request->city_id,
        ]);

       
        return response($place, 201);
    }


    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'name' => 'required',
            'city_id' => 'required',
        ]);

        $place = Place::find($id); 

        $place->update([
            'name' => $request->name,
            'city_id' => $request->city_id,
        ]);

        return response($place, 201);
    }

   
    public function destroy($id)
    {

        $place = Place::find($id); 

        $place->delete();

        return response($place, 201);
    }
}
