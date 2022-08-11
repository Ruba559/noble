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


    public function store(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required',
        ]);
      
        $propertyType = PropertyType::create([
            'name' => $request->name,
        ]);

       
        return response($propertyType, 201);
    }


    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'name' => 'required',
        ]);

        $propertyType = PropertyType::find($id); 

        $propertyType->update([
            'name' => $request->name,
        ]);

        return response($propertyType, 201);
    }

   
    public function destroy($id)
    {

        $propertyType = PropertyType::find($id); 

        $propertyType->delete();

        return response($propertyType, 201);
    }
}
