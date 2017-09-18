<?php

namespace App\Eloquent\Admin;

use Laratrust\LaratrustRole;

/**
 * @property mixed permissions
 * @property mixed users
 * @property mixed team
 * @property mixed name
 * @property mixed display_name
 * @property mixed description
 */
class Role extends LaratrustRole
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function team()
    {
        return $this->belongsToMany(Team::class, 'role_user', 'role_id', 'team_id')->using(RoleUser::class)->distinct();
    }

    /**
     * Search scope for the Role model.
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
