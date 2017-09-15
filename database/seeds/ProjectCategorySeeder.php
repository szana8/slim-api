<?php

use Illuminate\Database\Seeder;
use App\Eloquent\ProjectCategories;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProjectCategories::class, 10)->create()->each(function ($t) {
            $t->save();
        });
    }
}
