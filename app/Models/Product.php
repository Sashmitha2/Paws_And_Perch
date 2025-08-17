<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'category_id',
        'admin_id',
        'product_name',
        'price',
        'description',
        'image',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function orderitems(){
        return $this->hasMany(OrderItem::class);
    }

    public function admin(){
        return $this->belongsTo(User::class, 'admin_id');
    }
}
