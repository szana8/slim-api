<?php

namespace App\Transformers\Issue;

use App\Eloquent\Admin\Issue\CustomField;
use League\Fractal\TransformerAbstract;

class CustomFieldTransformer extends TransformerAbstract
{
    /**
     * @param CustomField $field
     * @return array
     */
    public function transform(CustomField $field)
    {
        return [
            'name' => $field->name,
            'description' => $field->description,
            'type' => $field->type,
            'api' => $field->api,
        ];
    }
}