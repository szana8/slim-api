<?php

namespace App\Transformers;

use App\Eloquent\Admin\GeneralSetting;
use League\Fractal\TransformerAbstract;

class GeneralSettingTransformer extends TransformerAbstract
{
    /**
     * @param GeneralSetting $setting
     * @return array
     */
    public function transform(GeneralSetting $setting)
    {
        return [
            'name'         => $setting->name,
            'display_name' => $setting->display_name,
            'description'  => $setting->description,
        ];
    }
}