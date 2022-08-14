<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PropertyTypeResources;
use App\Models\PropertyType;
use Illuminate\Support\Str;

class PropertyTypeController extends Controller
{
  
    public function index()
    {

        $PropertyType = PropertyType::get();

        return  PropertyTypeResources::collection($PropertyType);
     
    }

    public function slug($string, $separator = '-') {
        if (is_null($string)) {
            return "";
        }
    
        $string = trim($string);
    
        $string = mb_strtolower($string, "UTF-8");;
    
        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);
    
        $string = preg_replace("/[\s-]+/", " ", $string);
    
        $string = preg_replace("/[\s_]/", $separator, $string);
    
        return $string;
    }
    public function store(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required',
            'seo_title' => 'required',
            'seo_description' => 'required',
        ]);
      
        $propertyType = PropertyType::create([
            'name' => $request->name,
            'slug' => $this->slug($request->name),
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
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
