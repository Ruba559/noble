<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResources extends JsonResource
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
            'title' => $this->title ?? "",
            'description' => $this->description ?? "",
            'body' => $this->body ?? "",
            'image' => $this->image !=null? asset('storage'.$this->image):"" ,
            'author_id' =>  ! $this->user ? '' : new UserResources($this->user),
            'created_at'=> $this->created_at ?? "",
           

        ];
    }
}
