<?php

namespace App\Eloquent\Issue;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    /**
     * @var string
     */
    protected $table = 'issue_priorities';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'icon'];

    /**
     * Search scope for this model.
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
