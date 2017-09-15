<?php

return [

    /*
   |--------------------------------------------------------------------------
   | Issue table default field list
   |--------------------------------------------------------------------------
   |
   */

    'fields' => [
        ['name' => 'summary', 'type' => 'textarea', 'description' => 'Issue Summary', 'api' => null, 'protected' => true],
        ['name' => 'project', 'type' => 'select-with-list', 'description' => 'Issue Project Type', 'api' => 'api/v1/project', 'protected' => true],
        ['name' => 'issue_type', 'type' => 'select-with-list', 'description' => 'Issue Type', 'api' => 'api/v1/issueType', 'protected' => true],
        ['name' => 'description', 'type' => 'textarea', 'description' => 'Issue Description', 'api' => null, 'protected' => true],
        ['name' => 'priority', 'type' => 'select-with-list', 'description' => 'Issue Priority', 'api' => 'api/v1/priority', 'protected' => true],
        ['name' => 'issue_number', 'type' => 'text', 'description' => 'Issue Number', 'api' => null, 'protected' => true],
        ['name' => 'assignee', 'type' => 'select-with-list', 'description' => 'Issue Assignee', 'api' => 'api/v1/assignee', 'protected' => true],
        ['name' => 'reporter', 'type' => 'select-with-list', 'description' => 'Issue Reporter', 'api' => 'api/v1/reporter', 'protected' => true],
        ['name' => 'environment', 'type' => 'select-with-list', 'description' => 'Issue Environment', 'api' => 'api/v1/environment', 'protected' => true],
        ['name' => 'score', 'type' => 'text', 'description' => 'Issue Score', 'api' => null, 'protected' => true],
        ['name' => 'issue_status', 'type' => 'select-with-list', 'description' => 'Issue Status', 'api' => 'api/v1/status', 'protected' => true],
    ]

];