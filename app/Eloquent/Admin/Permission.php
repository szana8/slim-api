<?php

namespace App\Eloquent\Admin;

use Laratrust\LaratrustPermission;

class Permission extends LaratrustPermission
{
    protected $fillable = ['name', 'display_name', 'description'];

    /**
     * Search scope for the Permission model.
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
