<?php

use App\Eloquent\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Project::class, 20)->create()->each(function ($t) {
            $t->save();
        });
    }
}
