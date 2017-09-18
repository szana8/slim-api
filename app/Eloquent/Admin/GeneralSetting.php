<?php

namespace App\Eloquent\Admin;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    /**
     * @var string
     */
    protected $table = 'general_settings';

    /**
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description', 'value'];

    /**
     * Search scope for the General Setting model.
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
                $query->where('name', 'LIKE', "%$keyword%")
                    ->orWhere('display_name', 'LIKE', "%$keyword%")
                    ->orWhere('value', 'LIKE', "%$keyword%");
            });
        }

        return $query;
    }
}
