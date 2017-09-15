<?php

namespace App\Traits\Eloquent;

use App\Eloquent\ProjectCategories;

trait ProjectCategoryTrait
{
    /**
     * @return mixed
     */
    public function projectCategory()
    {
        return $this->hasOne(ProjectCategories::class, 'id', 'category');
    }
}
