<?php

namespace App\Eloquent\Issue;

use App\Eloquent\Admin\Issue\CustomField;
use Illuminate\Database\Eloquent\Model;

class ScreenConfig extends Model
{
    /**
     * @var string
     */
    protected $table = 'issue_screen_pivot';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['issue_screen_id', 'custom_field_id', 'tab'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields()
    {
        return $this->hasOne(CustomField::class, 'id', 'custom_field_id');
    }
}
