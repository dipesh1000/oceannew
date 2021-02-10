<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'title' => $this->title,
            'category_id'=> $this->category_id,
            'slug' => $this->slug,
            'book' => $this->book,
            'position' => $this->position,
            'image' => $this->image,
            'author' => $this->author,
            'isbn_no' => $this->isbn_no,
            'sku' => $this->sku,
            'edition' => $this->edition,
            'language' => $this->language,
            'description' => $this->description,
            'table_of_content' => $this->table_of_content,
            'status' => $this->status,
            'digital_or_hardcopy' => $this->digital_or_hardcopy,
            'quantity' => $this->quantity,
        ];
    }
}
