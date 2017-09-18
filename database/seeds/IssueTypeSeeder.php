<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Admin\Issue\IssueType;

class IssueTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(IssueType::class, 20)->create()->each(function ($t) {
            $t->save();
        });
    }
}
