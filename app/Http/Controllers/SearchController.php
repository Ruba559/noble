<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use App\Models\Office;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use DB;

class SearchController extends Controller
{
   
    public function Search(Request $request)
    {
        $words = explode(' ', $request->search); 
      
       $property_collection = new Collection;
       $propertyType_collection = new Collection;
       $office_collection = new Collection;

        foreach($words as $key => $word )
       {
           $property = Property::where('name' ,'like',"%" .$word .'%')->orwhere('title' ,'like',"%" .$word .'%')->orWhere('type' ,'like',"%" .$word .'%')->get();
           $propertyType = PropertyType::where('name' ,'like',"%" .$word .'%')->get();
           $office = Office::where('name' ,'like',"%" .$word .'%')->get();

           $property_collection->push((object)[
            'property' => $property,
            ]);   
            $propertyType_collection->push((object)[
                'propertyType' => $propertyType,
            ]);
            $office_collection->push((object)[
                'office' => $office,
            ]);
        
         
       }
       $all_collection = new Collection;
       $all_collection->push((object)[
        'property' => $property_collection,
        'propertyType' => $propertyType_collection,
        'office' => $office_collection,
    ]);
     
       return $all_collection->all();
     
    }
    

    public function getNear()
    {
        return  $this->getNearPropertyById(auth::user()->lat , auth::user()->long );
    }


    public function getNearPropertyById($lat , $long)
    {
         $user_lat = floatval($lat);
         $user_lng = floatval($long);
         
      $property = DB::table('properties')->select('*',
      DB::raw("6371 * acos(cos(radians(" . $user_lat . "))
      * cos(radians(properties.lat)) * cos(radians(properties.long) - radians(" . $user_lng . "))
      + sin(radians(" . $user_lat . ")) * sin(radians(properties.lat))
        ) AS distance"))->having('distance' , '<=' , floatval('100000'))->orderBy('distance','asc')->get();

        
             return $property;
             
    }
   

    
}
