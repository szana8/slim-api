<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ExceptionTransformer extends TransformerAbstract
{
    public function transform($e)
    {
        return [
            'message' => $e->getMessage(),
            'code'    => $e->getCode(),
        ];
    }
}
