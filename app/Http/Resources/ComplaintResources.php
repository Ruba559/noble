<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResources extends JsonResource
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
            'type' => $this->type ?? "",
            'description' => $this->description ?? "",
            'reply_message' => $this->reply_message ?? "",
            'replier' =>  ! $this->user ? '' : new UserResources($this->replierUser),
            'replied_at' => $this->replied_at ?? "",
            'created_at'=> $this->created_at ?? "",
           
        ];
    }
}
