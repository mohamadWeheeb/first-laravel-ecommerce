<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment'   =>  $this->faker->words(25 , true) ,
            'user_id'   =>  rand(12 , 50) ,
            'blog_id'   =>  rand(1 , 100) ,

        ];
    }
}
