<?php

use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Team::class, 10)->create()->each(function ($team) {
            factory(App\Models\Player::class, 10)->make()->each(function($player) use($team) {
                $team->players()->save($player);
            });
        });
    }
}
