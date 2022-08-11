<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\FavoriteResources;
use App\Models\Favorite;

class FavoriteController extends Controller
{
   
    public function index()
    {

        $favorite = Favorite::get();

        return  FavoriteResources::collection($favorite);
     
    }


    public function store(Request $request)
    {

        $fields = $request->validate([
            'property_id' => 'required',
            'user_id' => 'required',
        ]);
      
        $favorite = Favorite::create([
            'property_id' => $request->name,
            'user_id' => $request->city_id,
        ]);

       
        return response($favorite, 201);
    }


    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'property_id' => 'required',
            'user_id' => 'required',
        ]);

        $favorite = Favorite::find($id); 

        $favorite->update([
            'property_id' => $request->name,
            'user_id' => $request->city_id,
        ]);

        return response($favorite, 201);
    }

   
    public function destroy($id)
    {

        $favorite = Favorite::find($id); 

        $favorite->delete();

        return response($favorite, 201);
    }
}
