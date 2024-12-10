<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>User::all()->random()->id,
            'size'=>$this->faker->randomElement(['Small','Medium','Large','Extra Large']),
            'weight'=>$this->faker->randomFloat(2, 1, 1000),
            'weight_unit'=>$this->faker->randomElement(['Tone','kg', 'g']),
            'loading_location'=>$this->faker->address,
            'delivery_location'=>$this->faker->address,
            'pickup_time'=>$this->faker->dateTime(),
            'delivery_time'=>now()->addDays(rand(1,10)),
            'order_status'=>$this->faker->randomElement(['Pending','In Progress','Delivered']),
            'truck_type'=>$this->faker->randomElement(['Small','Medium','Large','Extra Large']),

        ];
    }
}
