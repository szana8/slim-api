<?php

use App\Eloquent\Admin\Issue\IssueType;
use Illuminate\Database\Seeder;

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
