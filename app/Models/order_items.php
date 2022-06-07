<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_items extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id' , 'price' , 'quantity' , 'product_id' ,
    ];

    protected $casts = [
        'price' =>  'float' ,
        'quantity'  =>  'int'
    ];



    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
