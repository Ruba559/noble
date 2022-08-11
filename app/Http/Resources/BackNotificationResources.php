<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BackNotificationResources extends JsonResource
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
            'from_id' => ! $this->user ? '' : new UserResources($this->user),
            'to_id' => ! $this->user ? '' : new UserResources($this->toUser),
            'message' => $this->message  ?? "",
            'payload' => $this->payload  ?? "",
            'created_at'=> $this->created_at ?? "",
           
        ];
    }
}
