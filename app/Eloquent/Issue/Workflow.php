<?php

namespace App\Eloquent\Issue;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'descriptor'];

    /**
     * @var array
     */
    protected $attributes = ['descriptor' => '{"class": "go.GraphLinksModel", "linkDataArray": [], "nodeDataArray": [], "linkToPortIdProperty": "toPort", "linkFromPortIdProperty": "fromPort"}'];
}
