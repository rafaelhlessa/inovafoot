<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Define number of players for each division
        $playersPerTeam = [
            '1' => 28,
            '2' => 28,
            '3' => 28,
            '4' => 28
        ];

        foreach ($playersPerTeam as $division => $numPlayers) {
            $teams = DB::table('teams')->where('championship_id', $division)->get();
            foreach ($teams as $team) {
                $goalkeepersCount = 0; // Track the number of goalkeepers
                $defenderCount = 0;
                $midfielderCount = 0;
                $forwardCount = 0;
                for ($i = 0; $i < $numPlayers; $i++) {
                    $position = $faker->randomElement(['Forward', 'Midfielder', 'Defender', 'Goalkeeper']);

                    // Ensure maximum 3 and minimum 2 goalkeepers per team
                    if ($position === 'Goalkeeper' && $goalkeepersCount >= 2) {
                        $position = $faker->randomElement(['Forward', 'Midfielder', 'Defender']);
                    }

                    if ($position === 'Goalkeeper') {
                        $goalkeepersCount++;
                    }

                    if ($position === 'Defender' && $defenderCount >= 6) {
                        $position = $faker->randomElement(['Forward', 'Midfielder']);
                    }

                    if ($position === 'Defender') {
                        $defenderCount++;
                    }

                    if ($position === 'Midfielder' && $midfielderCount >= 6) {
                        $position = $faker->randomElement(['Forward']);
                    }

                    if ($position === 'Midfielder') {
                        $midfielderCount++;
                    }

                    $strength = $faker->numberBetween(1, 100);
                    $price = $faker->numberBetween(100000, 10000000);
                    $salary = 0;

                    // Define salary and price based on team and strength
                    switch ($team->championship_id) {
                        case 1:
                            $salary = $faker->numberBetween(50000, 70000);
                            $price = $faker->numberBetween(8000000, 15000000);
                            $strength = $faker->numberBetween(65, 100);
                            break;
                        case 2:
                            $salary = $faker->numberBetween(30000, 50000);
                            $price = $faker->numberBetween(6000000, 10000000);
                            $strength = $faker->numberBetween(45, 70);
                            break;
                        case 3:
                            $salary = $faker->numberBetween(10000, 30000);
                            $price = $faker->numberBetween(4000000, 8000000);
                            $strength = $faker->numberBetween(15, 50);
                            break;
                        case 4:
                            $salary = $faker->numberBetween(1000, 10000);
                            $price = $faker->numberBetween(80000, 2000000);
                            $strength = $faker->numberBetween(5, 25);
                            break;
                    }

                    DB::table('players')->insert([
                        'name' => $faker->name,
                        'position' => $position,
                        'strength' => $strength,
                        'goals' => 0,
                        'red_cards' => 0,
                        'price' => $price,
                        'salary' => $salary,
                        //'contract' => $faker->numberBetween(1, 5), // Random contract length
                        'star' => $faker->boolean(20), // 20% chance of being a star
                        'team_id' => $team->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
