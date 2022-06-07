<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;


    ############### start Relations ##########

    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id' , 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class , 'blog_tag' , 'blog_id' , 'tag_id' , 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class , 'blog_id' , 'id');
    }
    ############### End Relations ############


    public function getImageUrlAttribute()
    {
        if($this->image)
        {
            return asset('storage/' . $this->image);
        }
        return asset('storage/defualt/defualtBlog.webp');
    }


}
