<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PropertyResources;
use App\Models\Property;
use App\Events\NotificationEvent;
use Pusher\Pusher;

class PropertyController extends Controller
{
   
    public function index()
    {

        $property = Property::get();

        return  PropertyResources::collection($property);
     
    }


    public function store(Request $request)
    {


        $fields = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'propery_type_id' => 'required',
            'price' => 'required',
            'title' => 'required',
            'description' => 'required',
            'city_id' => 'required',
            'space' => 'required',
            'place_id' => 'required',
            'adress' => 'required',
            'status' => 'required',
            'rooms' => 'required',
            'salons' => 'required',
            'baths' => 'required',
            'floor' => 'required',
            'direction_id' => 'required', 
            'cladding_id' => 'required',
            'mobile_phone' => 'required',
            'image' => 'required',
            'floors' => 'required',
            'divider' => 'required',

        ]); 

      
        $property = Property::create([
            'name' => $request->name,
            'type' => $request->type,
            'propery_type_id' => $request->propery_type_id,
            'price' => $request->price,
            'title' => $request->title,
            'description' => $request->description,
            'city_id' => $request->city_id,
            'space' => $request->space,
            'place_id' => $request->place_id,
            'adress' => $request->adress,
            'status' => $request->status,
            'rooms' => $request->rooms,
            'salons' => $request->salons,
            'baths' => $request->baths,
            'floor' => $request->floor,
            'direction_id' => $request->direction_id,
            'cladding_id' => $request->cladding_id,
            'mobile_phone' => $request->mobile_phone,
            'image' => $request->image,
            'floors' => $request->floors,
            'divider' => $request->divider,
            'views' => $request->views,
            'has_elevator' => $request->has_elevator,
            'has_generator' => $request->has_generator,
            'has_terrace' => $request->has_terrace,
            'has_pool' => $request->has_pool,
            'has_conditioner' => $request->has_conditioner,
            'has_saona' => $request->has_saona,
            'has_garag' => $request->has_garag,
            'has_shofag' => $request->has_shofag,
            'has_jacuzzi' => $request->has_jacuzzi,
            'has_garden' => $request->has_garden,
            'slug' => $this->slug($request->name),
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
        ]);

        event(new NotificationEvent('data'));

        return response($property, 201);
    }


    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'propery_type_id' => 'required',
            'price' => 'required',
            'title' => 'required',
            'description' => 'required',
            'city_id' => 'required',
            'space' => 'required',
            'place_id' => 'required',
            'adress' => 'required',
            'status' => 'required',
            'rooms' => 'required',
            'salons' => 'required',
            'baths' => 'required',
            'floor' => 'required',
            'direction_id' => 'required', 
            'cladding_id' => 'required',
            'mobile_phone' => 'required',
            'image' => 'required',
            'floors' => 'required',
            'divider' => 'required',
        ]); 

        $property = Property::find($id); 

        $property->update([
            'name' => $request->name,
            'type' => $request->type,
            'propery_type_id' => $request->propery_type_id,
            'price' => $request->price,
            'title' => $request->title,
            'description' => $request->description,
            'city_id' => $request->city_id,
            'space' => $request->space,
            'place_id' => $request->place_id,
            'adress' => $request->adress,
            'status' => $request->status,
            'rooms' => $request->rooms,
            'salons' => $request->salons,
            'baths' => $request->baths,
            'floor' => $request->floor,
            'direction_id' => $request->direction_id,
            'cladding_id' => $request->cladding_id,
            'mobile_phone' => $request->mobile_phone,
            'image' => $request->image,
            'floors' => $request->floors,
            'divider' => $request->divider,
            'views' => $request->views,
            'has_elevator' => $request->has_elevator,
            'has_generator' => $request->has_generator,
            'has_terrace' => $request->has_terrace,
            'has_pool' => $request->has_pool,
            'has_conditioner' => $request->has_conditioner,
            'has_saona' => $request->has_saona,
            'has_garag' => $request->has_garag,
            'has_shofag' => $request->has_shofag,
            'has_jacuzzi' => $request->has_jacuzzi,
            'has_garden' => $request->has_garden,
            'slug' => $this->slug($request->name),
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
        ]);

        return response($property, 201);
    }

   
    public function destroy($id)
    {

        $property = Property::find($id); 

        $property->delete();

        return response($property, 201);
    }


    public function slug($string, $separator = '-')
    {
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
}
