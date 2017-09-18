<?php

namespace App\Eloquent\Admin\Issue;

use Illuminate\Database\Eloquent\Model;

class IssueResolution extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'description'];

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

    public function getFillable()
    {
        return $this->fillable;
    }
}
