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
use Abdullah\UserGeoLocation\GeoLocation;
use Geocoder;
use DB;

class SearchController extends Controller
{
   
    public function Search(Request $request)
    {
        $words = explode(' ', $request->search); 
      //  $words = str_split($request->search , 2);
      
        //$wordCount = Str::of($request->search)->wordCount();
      // return $words[0];
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
    //   $property = Property::first();
       //return  $this->distance(auth::user()->lat, auth::user()->long, $property->lat, $property->long, 'k') ;
     // return  $this->getNearPropertyById(auth::user()->long , auth::user()->lat);
       return $all_collection->all();
     
    }
   
    public function getNearPropertyById($long , $lat)
    {
        
          
      $property = DB::table('properties')->select('*',DB::raw("6371 * acos(cos(radians(" . floatval($lat) . "))
      * cos(radians(lat)) * cos(radians(long) - radians(" . floatval($long) . "))
      + sin(radians(" . $lat . ")) * sin(radians(lat))
        ) AS distance"))->having('distance' , '<=' , floatval('100000'))->orderBy('distance','asc')->first();

    
             return $property->id;
             
    }
   

    public function distance($lat1, $lon1, $lat2, $lon2, $unit) 
    {
 
         if (($lat1 == $lat2) && ($lon1 == $lon2)) {
           return 0;
         }
 
         else {
           $theta = $lon1 - $lon2;
           $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
           $dist = acos($dist);
           $dist = rad2deg($dist);
           $miles = $dist * 60 * 1.1515;
           $unit = strtoupper($unit);
         
                   if ($unit == "K") {
                     return ($miles * 1.609344);
                   } else if ($unit == "N") {
                     return (int)($miles * 0.8684);
                   } else {
                     return (int)$miles;
           }
   }
 }
}
