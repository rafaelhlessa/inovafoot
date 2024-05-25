<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;
use Faker\Provider\Base as BaseProvider;

class CustomFakerProvider extends BaseProvider
{
    public function teamCapacity($championshipId)
    {
        switch ($championshipId) {
            case 1:
                return $this->generator->numberBetween(60000, 90000);
            case 2:
                return $this->generator->numberBetween(40000, 60000);
            case 3:
                return $this->generator->numberBetween(15000, 40000);
            case 4:
                return $this->generator->numberBetween(5000, 15000);
            default:
                return $this->generator->numberBetween(5000, 90000); // Default range
        }
    }

    public function teamMoney($championshipId)
    {
        switch ($championshipId) {
            case 1:
                return $this->generator->numberBetween(7000000, 10000000);
            case 2:
                return $this->generator->numberBetween(4000000, 7000000);
            case 3:
                return $this->generator->numberBetween(2000000, 4000000);
            case 4:
                return $this->generator->numberBetween(1500000, 2000000);
            default:
                return $this->generator->numberBetween(1500000, 10000000); // Default range
        }
    }

    public function teamMorale()
    {
        return $this->generator->numberBetween(20, 50);
    }
}

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        // Add the custom provider
        $faker->addProvider(new CustomFakerProvider($faker));

        // Define number of fake records you want to create
        $numTeams = 32;

        for ($i = 0; $i < $numTeams; $i++) {
            $championshipId = $faker->numberBetween(1, 4);

            DB::table('teams')->insert([
                'name' => $faker->unique()->word . ' FC',
                'capacity' => $faker->teamCapacity($championshipId),
                'championship_id' => $championshipId,
                'loan' => $faker->boolean(0), // 20% chance of having a loan
                'morale' => $faker->teamMorale(),
                'money' => $faker->teamMoney($championshipId),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
