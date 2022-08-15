<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoryResources extends JsonResource
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
            'image' => $this->image !=null? asset('storage'.$this->image):"" ,
            'title' => $this->title ?? "",
            'property' => ! $this->property ? '' :  new PropertyResources($this->property),
            'office' => ! $this->office ? '' :  new OfficeResources($this->office),
            'created_at'=> $this->created_at ?? "",
           
        ];
    }
}
