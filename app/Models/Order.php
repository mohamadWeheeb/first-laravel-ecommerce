<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'first_name', 'last_name', 'email' , 'phone',
        'address','city','country_code' ,'postal_code' ,'status','totle'
    ];

    public function items()
    {
        return $this->hasMany(order_items::class );
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }


    protected $casts = [
        'totle' =>  'float' ,
    ];

}
