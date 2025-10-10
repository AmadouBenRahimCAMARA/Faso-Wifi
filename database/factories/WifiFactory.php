<?php

namespace Database\Factories;

use App\Models\Wifi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wifi>
 */
class WifiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wifi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => fake()->company() . ' Wifi',
            'slug' => Str::slug(fake()->unique()->company() . ' Wifi'),
            'description' => fake()->paragraph(),
            'user_id' => User::inRandomOrder()->first()->id, // Assign to a random existing user
        ];
    }
}