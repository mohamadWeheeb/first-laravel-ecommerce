<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        return [
            'name'  =>  $name ,
            'description'   =>  $this->faker->text(500) ,
            'user_id'       =>  rand(1 , 9) ,
            'parent_id'     =>  rand(1 , 10) ,
            'slug'          =>  Str::slug($name) ,

        ];
    }
}
