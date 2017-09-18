<?php

use App\Eloquent\ProjectCategories;
use Illuminate\Database\Seeder;

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
