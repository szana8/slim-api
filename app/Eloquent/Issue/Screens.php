<?php

namespace App\Eloquent\Issue;

use App\Eloquent\Admin\Issue\CustomField;
use Illuminate\Database\Eloquent\Model;

class Screens extends Model
{
    /**
     * @var string
     */
    protected $table = 'issue_screens';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * Pivot join to the custom field table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fields()
    {
        return $this->belongsToMany(CustomField::class, 'issue_screen_pivot', 'issue_screen_id', 'custom_field_id');
    }

    /**
     * Search scope for this model.
     *
     * @param $query
     * @param $keyword
     * @return mixed
     */
    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            return $query->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            });
        }

        return $query;
    }
}
