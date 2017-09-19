<?php

namespace App\Eloquent\Admin\Issue;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name
 * @property mixed description
 * @property mixed type
 * @property mixed api
 */
class CustomField extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'type', 'api', 'protected'];

}
