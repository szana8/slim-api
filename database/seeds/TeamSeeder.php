<?php

use App\Eloquent\Admin\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Team::class, 1000)->create()->each(function ($t) {
            $t->save();
        });
    }
}
