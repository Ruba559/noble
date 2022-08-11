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


    public function store(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required',
        ]);

      
        $city = City::create([
            'name' => $request->name,
            
        ]);

       
        return response($city, 201);
    }


    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'name' => 'required',
        ]);

        $city = City::find($id); 

        $city->update([
            'name' => $request->name,
            
        ]);

        return response($city, 201);
    }

   
    public function destroy($id)
    {

        $city = City::find($id); 

        $city->delete();

        return response($city, 201);
    }
}
