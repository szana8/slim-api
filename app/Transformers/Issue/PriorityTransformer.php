<?php


namespace app\Transformers\Issue;


use App\Eloquent\Issue\Priority;
use League\Fractal\TransformerAbstract;

class PriorityTransformer extends TransformerAbstract
{
    /**
     * @param Priority $priority
     * @return array
     */
    public function transform(Priority $priority)
    {
        return [
            'name' => $priority->name,
            'description' => $priority->description,
            'icon' => $priority->icon,
        ];
    }
}