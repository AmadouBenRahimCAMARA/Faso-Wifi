<?php

namespace Database\Factories;

use App\Models\Tarif;
use App\Models\Wifi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarif>
 */
class TarifFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tarif::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $forfaits = ['1 heure', '3 heures', '1 jour', '1 semaine', '1 mois'];
        $montants = [100, 250, 500, 2000, 5000];
        $randomKey = array_rand($forfaits);

        return [
            'forfait' => $forfaits[$randomKey],
            'montant' => $montants[$randomKey],
            'slug' => Str::slug(fake()->unique()->word() . ' tarif'),
            'description' => fake()->sentence(),
            'wifi_id' => Wifi::inRandomOrder()->first()->id, // Assign to a random existing wifi
            'user_id' => User::inRandomOrder()->first()->id, // Assign to a random existing user
        ];
    }
}