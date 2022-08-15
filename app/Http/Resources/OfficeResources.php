<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeResources extends JsonResource
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
            'name' => $this->name ?? "",
            'logo' => $this->logo !=null? asset('storage'.$this->logo):"" ,
            'cover' => $this->cover !=null? asset('storage'.$this->cover):"" ,
            'mobile_number' => $this->mobile_number ?? "",
            'address' => $this->address ?? "",
            'description' => $this->description ?? "",
            'status' => $this->status ?? "",
            'user' => ! $this->user ? '' :  new UserResources($this->user),
            'city' => ! $this->city ? '' :  new CityResources($this->city),
            'slug' => $this->slug ?? "",
            'url' => $this->url ?? "",
            'created_at'=> $this->created_at ?? "",
           
        ];
    }
}
