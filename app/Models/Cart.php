<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id' , 'user_id' , 'quantity' , 'product_id'];



    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id')->withDefault();
    }


    public function getTotleAttribute()
    {
        return $this->product->price * $this->quantity ;
    }
}
