<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChampionshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('championship')->insert([
            [
                'name' => 'Série A',
                'division' => 1,
                'player_limit' => 28,
                'team_limit' => 8,
                'format_championship' => 'Campeonato',
                'games' => 14,
                'created_at' => now(),
            ],
            [
                'name' => 'Série B',
                'division' => 2,
                'player_limit' => 28,
                'team_limit' => 8,
                'format_championship' => 'Campeonato',
                'games' => 14,
                'created_at' => now(),
            ],
            [
                'name' => 'Série C',
                'division' => 3,
                'player_limit' => 28,
                'team_limit' => 8,
                'format_championship' => 'Campeonato',
                'games' => 14,
                'created_at' => now(),
            ],
            [
                'name' => 'Série D',
                'division' => 4,
                'player_limit' => 28,
                'team_limit' => 8,
                'format_championship' => 'Campeonato',
                'games' => 14,
                'created_at' => now(),
            ],
        ]);
    }
}
