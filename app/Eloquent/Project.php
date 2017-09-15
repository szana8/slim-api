<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Eloquent\ProjectLeadTrait;
use App\Traits\Eloquent\ProjectCategoryTrait;
use App\Traits\Eloquent\ProjectDefaultAssigneeTrait;

class Project extends Model
{
    use ProjectDefaultAssigneeTrait, ProjectCategoryTrait, ProjectLeadTrait;
}
