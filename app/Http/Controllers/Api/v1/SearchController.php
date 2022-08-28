<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use App\Models\Office;
use App\Models\Place;
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
     
       return response($all_collection->all());
     
    }
}
