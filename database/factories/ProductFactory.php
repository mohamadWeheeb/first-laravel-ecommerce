<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ProductFactory extends Factory
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
            'price' =>  $this->faker->randomFloat(2 , 100 , 900) ,
            'discount'  =>  $this->faker->randomFloat(2 , 10 , 90) ,
            'quantity'  =>  $this->faker->numberBetween(5 , 90) ,
            'category_id'   =>  rand(22 , 100) ,
            'user_id'   =>  rand(1 , 20) ,
        'slug'      =>Str::slug($name) ,

        ];
    }
}
