<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Tarif;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::where('email', 'admin@example.com')->first();
        $tarifs = Tarif::all();

        if ($adminUser && $tarifs->isNotEmpty()) {
            foreach ($tarifs as $tarif) {
                Ticket::create([
                    'user' => 'user_' . Str::random(5),
                    'password' => Str::random(8),
                    'dure' => $tarif->forfait,
                    'etat_ticket' => 'EN_VENTE',
                    'slug' => Str::random(10),
                    'tarif_id' => $tarif->id,
                    'user_id' => $adminUser->id,
                ]);

                Ticket::create([
                    'user' => 'user_' . Str::random(5),
                    'password' => Str::random(8),
                    'dure' => $tarif->forfait,
                    'etat_ticket' => 'VENDU',
                    'vente_date' => now(),
                    'slug' => Str::random(10),
                    'tarif_id' => $tarif->id,
                    'user_id' => $adminUser->id,
                ]);
            }
            Ticket::factory(20)->create(); // Create 20 additional random tickets
        }
    }
}