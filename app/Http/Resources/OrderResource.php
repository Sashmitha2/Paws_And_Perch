<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use App\Http\Resources\OrderItemResource;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user_id'=>$this->user_id,
            'address'=>$this->address,
            'total_amount'=>$this->total_amount,
            'order_status'=>$this->order_status,
            'user'=>new UserResource($this->whenLoaded('user')),
            'items'=> OrderItemResource::collection($this->whenLoaded('items')),
            'payment'=>new PaymentResource($this->whenLoaded('payment')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
