<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //

    protected $fillable = [
        'order_id',
        'amount',
        'payment_method',
        'payment_status',
    ];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}
