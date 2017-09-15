<?php

namespace App\Traits\Eloquent;

use App\User;

trait ProjectDefaultAssigneeTrait
{
    /**
     * @return mixed
     */
    public function defaultAssignee()
    {
        return $this->hasOne(User::class, 'id', 'default_assignee');
    }
}
