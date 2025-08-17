<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'phone_number',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //a customer has only one cart
    public function cart(){

        return $this->hasOne(Cart::class, 'user_id');
    }

    //a customer can place many orders
    public function orders(){
        return $this->hasMany(Order::class, 'user_id');
    }

    //an admin can manage many products
    public function product(){
        return $this->hasMany(Product::class, 'admin_id' );
    }


    //check if user is an admin
    public function isAdmin(){
        return $this->role === 'Admin';
    }

    //chacke if user is a customer
    public function isCustomer(){
        return $this->role=== 'Customer';
    }
}
