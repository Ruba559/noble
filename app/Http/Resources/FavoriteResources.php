<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
 
            'id' => $this->id,
            'user' => ! $this->user ? '' : new UserResources($this->user),
            'property' => ! $this->property ? '' : new PropertyResources($this->property),
            'created_at'=> $this->created_at ?? "",
           
        ];
    }
}
