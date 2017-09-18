<?php

namespace App\Eloquent\Admin\Issue;

use Illuminate\Database\Eloquent\Model;

class IssueStatus extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'category'];

    /**
     * Search scope for the IssueType model.
     *
     * @param $query
     * @param $keyword
     *
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
