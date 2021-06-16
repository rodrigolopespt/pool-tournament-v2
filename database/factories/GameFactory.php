<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Friend;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Game::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('-7 days', 'today')->format('Y-m-d'),
            'tournament_id' => 1,
            'winner_id' => Friend::inRandomOrder()->first()->id,
            'no_show' => $no_show = rand(0,1),
            'balls_left' => $no_show ? 0 : rand(1,7),
        ];
    }
}
