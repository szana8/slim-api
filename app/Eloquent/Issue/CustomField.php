<?php

namespace App\Eloquent\Admin\Issue;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    protected $fillable = ['name', 'description', 'type', 'api', 'protected'];
}
