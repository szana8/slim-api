<?php

use App\User;
use App\Eloquent\Admin\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(GeneralSettingsTableSeeder::class);

        if (env('APP_ENV') == 'local' || env('APP_ENV') == 'dev') {
            $this->runFakers();
        }
        $this->call(ProjectCategorySeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(IssueTypeSeeder::class);
        $this->call(IssueStatusSeeder::class);
        $this->call(IssueResolutionSeeder::class);
        $this->call(CustomFieldDefaultSeeder::class);
        $this->call(WorkflowSeeder::class);

    }

    protected function runFakers()
    {
        $this->call(TeamSeeder::class);

        $user = new User();
        $user->name = 'Administrator';
        $user->password = bcrypt('adminadmin');
        $user->email = 'admi@admin.com';
        $user->save();

        $user->attachRole(Role::find(1));
    }
}
