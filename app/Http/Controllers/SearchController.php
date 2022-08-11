<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;

class SearchController extends Controller
{
   
    public function Search(Request $request)
    {
        $words = str_split($request->search , 2);
        return  $words;
        $wordCount = Str::of($request->search)->wordCount();

        if($wordCount == '1')
        {
            $property = Property::where('name' , $request->search)->get();
            $propertyType = PropertyType::where('name' , $request->search)->get();
            $user = User::where('name' , $request->search)->get();
        }

       foreach($wordCount as $item)
       {
        return ;
       }
        $word= strtok($request->search, " ");
      
    
        $test = Str::of($request->search)->after($word);
            return $test;
        return $wordCount;
    }
}
