<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderResource extends ResourceCollection
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
            'data' => $this->collection->map(function($data){
                return [
                    'id' => $data->id,
                    'invoice_no'=>$data->id,
                    'grand_total'=>$data->grandTotal,
                    'payment_method'=>$data->payment_method
                ];
         
            }),
        ];
    }
}
