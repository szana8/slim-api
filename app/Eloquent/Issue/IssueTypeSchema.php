<?php

namespace App\Eloquent\Admin\Issue;

use Illuminate\Database\Eloquent\Model;

class IssueTypeSchema extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'default_type'];

    /**
     * @var string
     */
    protected $table = 'issue_type_scheme';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function issueTypes()
    {
        return $this->belongsToMany(IssueType::class, 'issue_type_scheme_pivot', 'issue_type_scheme_id', 'issue_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function defaultIssueType()
    {
        return $this->hasOne(IssueType::class, 'id', 'default_type');
    }

    /**
     * @param array $issueTypes
     *
     * @return array
     */
    public function syncIssueTypes(array $issueTypes)
    {
        return $this->issueTypes()->sync($issueTypes);
    }

    /**
     * Search scope for the IssueTypeSchema model.
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
