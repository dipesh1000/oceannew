<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title"=> $this->title,
            "slug"=> $this->slug,
            "parent_id"=> $this->parent_id,
            "icon"=> $this->icon,
            "image"=> $this->image,
            "status"=> $this->status,
            "description"=> $this->description,
            "childs" => $this->childs ? self::collection($this->childs) : []
        ];
    }
}
