<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Admin\GeneralSetting;

class GeneralSettingsTableSeeder extends Seeder
{
    protected $generalSettings = [
        [
            'name'         => 'EMAIL_OUTPUT',
            'display_name' => 'Email output',
            'description'  => 'You can enable or disable the output emails from the system. You may need to disable this functionality on the dev system.',
            'value'        => 'TRUE',
        ],
    ];

    protected $setting;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->generalSettings as $setting) {
            $generalSetting = new GeneralSetting();

            $generalSetting->name = $setting['name'];
            $generalSetting->display_name = $setting['display_name'];
            $generalSetting->description = $setting['description'];
            $generalSetting->value = $setting['value'];

            $generalSetting->save();
        }
    }
}
