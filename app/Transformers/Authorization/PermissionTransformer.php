<?php

namespace App\Transformers\Authorization;

use App\Eloquent\Admin\Permission;
use League\Fractal\TransformerAbstract;

class PermissionTransformer extends TransformerAbstract
{
    /**
     * @param Permission $permission
     *
     * @return array
     */
    public function transform(Permission $permission)
    {
        return [
            'name'         => $permission->name,
            'display_name' => $permission->display_name,
            'description'  => $permission->description,
        ];
    }
}
