<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'product_name'=>$this->product_name,
            'price'=>$this->price,
            'description'=>$this->description,
            'image'=>$this->image,
            'category'=>new CategoryResource($this->whenLoaded('category')),
            'orderitems'=>OrderItemResource::collection($this->whenLoaded('orderitems')),
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
