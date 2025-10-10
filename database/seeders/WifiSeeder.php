<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Wifi;
use App\Models\User;
use Illuminate\Support\Str;

class WifiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::where('email', 'admin@example.com')->first();

        if ($adminUser) {
            Wifi::create([
                'nom' => 'WiLink-Tickets Central',
                'slug' => Str::slug('WiLink-Tickets Central'),
                'description' => 'Réseau Wi-Fi principal situé au centre-ville.',
                'user_id' => $adminUser->id,
            ]);

            Wifi::create([
                'nom' => 'WiLink-Tickets Annexe',
                'slug' => Str::slug('WiLink-Tickets Annexe'),
                'description' => 'Réseau Wi-Fi secondaire pour les zones périphériques.',
                'user_id' => $adminUser->id,
            ]);

            Wifi::factory(5)->create(); // Create 5 additional random wifis
        }
    }
}