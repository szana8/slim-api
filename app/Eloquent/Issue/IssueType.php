<?php

namespace App\Eloquent\Admin\Issue;

use Illuminate\Database\Eloquent\Model;

class IssueType extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'type', 'description', 'icon'];

    /**
     * Search scope for the IssueType model.
     *
     * @param $query
     * @param $keyword
     * @return mixed
     */
    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            return $query->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%")
                    ->orWhere('type', 'LIKE', "%$keyword%");
            });
        }

        return $query;
    }
}
