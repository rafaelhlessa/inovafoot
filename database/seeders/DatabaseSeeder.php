<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Manager;
use App\Models\Team;
use App\Models\Player;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            ChampionshipSeeder::class,
            ManagerSeeder::class,
            TeamsSeeder::class,
            PlayersSeeder::class
        ]);
    }
}
