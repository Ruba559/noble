<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResources extends JsonResource
{
    
    public function toArray($request)
    {
        return [
 
            'id' => $this->id,
            'name' => $this->name ?? "",
            'city' => ! $this->city ? '' :  new CityResources($this->city),
            'created_at'=> $this->created_at ?? "",
           
        ];
    }
}
