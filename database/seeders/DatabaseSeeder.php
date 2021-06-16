<?php

namespace Database\Seeders;

use App\Services\StatsService;
use Illuminate\Database\Seeder;
use Database\Seeders\GameSeeder;
use Database\Seeders\FriendSeeder;
use Database\Seeders\TournamentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FriendSeeder::class,
            TournamentSeeder::class,
            GameSeeder::class
        ]);

        StatsService::calculateStats();
        StatsService::calculateRankings();
    }
}
