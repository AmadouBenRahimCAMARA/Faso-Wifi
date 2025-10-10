<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tarif;
use App\Models\Wifi;
use App\Models\User;
use Illuminate\Support\Str;

class TarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::where('email', 'admin@example.com')->first();
        $wifis = Wifi::all();

        if ($adminUser && $wifis->isNotEmpty()) {
            foreach ($wifis as $wifi) {
                Tarif::create([
                    'forfait' => '1 heure',
                    'montant' => '100',
                    'slug' => Str::slug($wifi->nom . ' 1 heure'),
                    'description' => 'Accès Wi-Fi pour 1 heure.',
                    'wifi_id' => $wifi->id,
                    'user_id' => $adminUser->id,
                ]);

                Tarif::create([
                    'forfait' => '3 heures',
                    'montant' => '250',
                    'slug' => Str::slug($wifi->nom . ' 3 heures'),
                    'description' => 'Accès Wi-Fi pour 3 heures.',
                    'wifi_id' => $wifi->id,
                    'user_id' => $adminUser->id,
                ]);

                Tarif::create([
                    'forfait' => '1 jour',
                    'montant' => '500',
                    'slug' => Str::slug($wifi->nom . ' 1 jour'),
                    'description' => 'Accès Wi-Fi pour 1 journée complète.',
                    'wifi_id' => $wifi->id,
                    'user_id' => $adminUser->id,
                ]);
            }
            Tarif::factory(10)->create(); // Create 10 additional random tarifs
        }
    }
}