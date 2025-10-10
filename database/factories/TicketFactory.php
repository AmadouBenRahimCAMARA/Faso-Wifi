<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\Tarif;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $etatTickets = ['EN_VENTE', 'VENDU', 'EXPIRE'];

        return [
            'user' => fake()->userName(),
            'password' => Str::random(8),
            'dure' => fake()->randomElement(['1 heure', '3 heures', '1 jour']),
            'etat_ticket' => fake()->randomElement($etatTickets),
            'vente_date' => fake()->optional()->dateTimeBetween('-1 month', 'now'),
            'slug' => Str::random(10),
            'tarif_id' => Tarif::inRandomOrder()->first()->id, // Assign to a random existing tarif
            'user_id' => User::inRandomOrder()->first()->id, // Assign to a random existing user
        ];
    }
}