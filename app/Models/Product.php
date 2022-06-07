<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name'  , 'category_id'
        , 'price' ,'discount'
        , 'quantity' , 'description'
        ,'user_id' , 'slug'
        ,'image' ,
    ];
    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id' , 'id');
    }



    public function getimageUrlAttribute()
    {
        if($this->image)
        {
            return asset('storage/' . $this->image);
        }
        return asset('storage/defualt/defualtProduct.png');
    }
}
