<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    //
    protected $filllable = [
        'name',
        'slug',
        'parent_category_id',
    ];


    public function products(){
        return $this->hasMany(Product::class);

    }


    public function children(){
        return $this->hasMany(Category::class, 'parent_category_id');
    }
}
