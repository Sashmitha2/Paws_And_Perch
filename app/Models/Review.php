<?php

namespace App\Models;

//use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;


class Review extends Model
{
    protected $connection = 'mongodb';
     protected $collection = 'review';

    // Fields you want to allow mass assignment for
    protected $fillable = [
        'user_id',
        'rating',
        'comment',
        'image',
        'created_at',
        'updated_at',
    ];

}
