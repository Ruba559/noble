<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResources extends JsonResource
{
   
    public function toArray($request)
    {
        return [
 
            'id' => $this->id,
            'name' => $this->name ?? "",
            'type' => $this->type ?? "",
            'propery_type_id' => ! $this->propertyType ? '' : new PropertyTypeResources($this->propertyType) ?? "",
            'price' => $this->price ?? "0",
            'title' => $this->title ?? "",
            'description' => $this->description  ?? "",
            'city' => ! $this->city ? '' : new CityResources($this->city) ,
            'space' => $this->space  ?? "",
            'place' => ! $this->place ? '' : new PlaceResources($this->place),
            'adress' => $this->adress  ?? "",
            'status' => $this->status  ?? "",
            'rooms' => $this->rooms ?? "",
            'salons' => $this->salons ?? "",
            'baths' => $this->baths ?? "",
            'floor' => $this->floor ?? "",
            'direction' => ! $this->direction ? '' : new DirectionResources($this->direction),
            'cladding' => ! $this->cladding ? '' : new CladdingResources($this->cladding),
            'mobile_phone' => $this->mobile_phone?? "",
            'image' => $this->image !=null? asset('storage'.$this->image):"" ,
            'floors' => $this->floors ?? "",
            'divider' => $this->divider ?? "",
            'views' => $this->views ?? "0",
            'has_elevator' => $this->has_elevator  ?? "0",
            'has_generator' => $this->has_generator ?? "0",
            'has_terrace' => $this->has_terrace ?? "0",
            'has_pool' => $this->has_pool ?? "0",
            'has_conditioner' => $this->has_conditioner ?? "0",
            'has_saona' => $this->has_saona ?? "0",
            'has_garag' => $this->has_garag ?? "0",
            'has_shofag' => $this->has_shofag ?? "0",
            'has_jacuzzi' => $this->has_jacuzzi ?? "0",
            'has_garden' => $this->has_garden ?? "0",
            'slug' => $this->slug ?? "",
            'created_at'=> $this->created_at?? "",
          
        ];
    }
}
