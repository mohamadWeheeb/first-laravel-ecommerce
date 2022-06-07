<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' =>  $this->faker->words(10 , true),
            'body'  =>  $this->faker->text(1000) ,
            'user_id'   =>  rand(1, 5) ,
            'category_id'   =>  rand(12 , 50) ,

        ];
    }
}
