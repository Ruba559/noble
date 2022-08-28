<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
{
  
    public function toArray($request)
    {
        return [
 
            'id' => $this->id,
            'name' => $this->name ?? "",
            'email' => $this->email ?? "",
            'mobile_number' => $this->mobile_number ?? "",
            'created_at'=> $this->created_at ?? "",

        ];
    }
}
