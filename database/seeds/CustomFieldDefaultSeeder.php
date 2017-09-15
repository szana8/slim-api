<?php

use App\Eloquent\Admin\Issue\CustomField;
use Illuminate\Database\Seeder;

class CustomFieldDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaults = config('issue.fields');
        foreach($defaults as $default)
        {
            $customField = new CustomField();
            $customField->name = $default['name'];
            $customField->description = $default['description'];
            $customField->type = $default['type'];
            $customField->api = $default['api'];
            $customField->protected = $default['protected'];
            $customField->save();
        }

    }
}
