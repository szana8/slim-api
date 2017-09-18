<?php

namespace App\Eloquent\Admin;

use Laratrust\LaratrustTeam;

/**
 * @property mixed description
 * @property mixed display_name
 * @property mixed name
 */
class Team extends LaratrustTeam
{
    protected $fillable = ['name', 'display_name', 'description'];

    /**
     * Search scope for the Team model.
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
                    ->orWhere('display_name', 'LIKE', "%$keyword%");
            });
        }

        return $query;
    }
}
