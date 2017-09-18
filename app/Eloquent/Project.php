<?php

namespace App\Eloquent;

use App\Traits\Eloquent\ProjectCategoryTrait;
use App\Traits\Eloquent\ProjectDefaultAssigneeTrait;
use App\Traits\Eloquent\ProjectLeadTrait;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use ProjectDefaultAssigneeTrait, ProjectCategoryTrait, ProjectLeadTrait;
}
