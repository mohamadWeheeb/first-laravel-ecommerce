<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    ############### start Relations ##########

    public function blog()
    {
        return $this->belongsTo(Blog::class , 'blog_id' , 'id');
    }
    ############### End Relations ############
}