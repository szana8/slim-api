<?php

namespace App\Traits\Eloquent;

use App\User;

trait ProjectLeadTrait
{
    /**
     * @return mixed
     */
    public function projectLead()
    {
        return $this->hasOne(User::class, 'id', 'lead');
    }
}
