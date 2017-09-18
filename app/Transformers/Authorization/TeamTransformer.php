<?php


namespace App\Transformers\Authorization;


use App\Eloquent\Admin\Team;
use League\Fractal\TransformerAbstract;

class TeamTransformer extends TransformerAbstract
{
    /**
     * Return Array of the teams.
     *
     * @param Team $team
     * @return array
     */
    public function transform(Team $team)
    {
        return [
            'name' => $team->name,
            'display_name' => $team->display_name,
            'description' => $team->description,
        ];
    }
}