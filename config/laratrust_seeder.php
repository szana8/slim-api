<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'user'                  => 'c,r,u,d',
            'role'                  => 'c,r,u,d',
            'permission'            => 'c,r,u,d',
            'setting'               => 'c,r,u,d',
            'team'                  => 'c,r,u,d',
            'teamrole'              => 'c,r,u,d',
            'project'               => 'c,r,u,d',
            'issue-type'            => 'c,r,u,d',
            'issue-type-schema'     => 'c,r,u,d',
            'issue-status'          => 'c,r,u,d',
            'issue-type-resolution' => 'c,r,u,d',
            'custom-field'          => 'c,r,u,d',
            'priority'              => 'c,r,u,d',
            'screen'                => 'c,r,u,d',
            'screen-config'         => 'c,r,u,d',
            'workflow'              => 'c,r,u,d',
        ],
        /*'administrator' => [
            'user'       => 'c,r,u,d',
            'role'       => 'c,r,u,d',
            'permission' => 'c,r,u,d',
            'teamrole'   => 'c,r,u,d',
            'project'   => 'c,r,u,d',
            'issue_type' => 'c,r,u,d',
            'issue_type_schema' => 'c,r,u,d',
            'issue_status' => 'c,r,u,d',
            'issue_type_resolution' => 'c,r,u,d',
            'custom_field' => 'c,r,u,d',
            'priority' => 'c,r,u,d',
            'screens' => 'c,r,u,d'
        ],*/
        'user' => [

        ],
    ],
    'permission_structure' => [
        'cru_user' => [
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
