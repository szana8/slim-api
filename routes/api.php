<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->prefix('v1')->group(function () {


    // Sign up route
    Route::post('auth/signup', 'Auth\AuthController@signUp');

    // Sign in route
    Route::post('auth/signin', 'Auth\AuthController@signIn');

    /*
     *
     * Need to create an admin middleware and add these routes to that
     *
     */

    Route::namespace('Admin')->middleware('jwt.auth')->group(function () {

        // Users Routes
        Route::resource('user', 'UserController', ['except' => [
            'create', 'edit'
        ]]);

        // Roles Routes
        Route::resource('role', 'RoleController', ['except' => [
            'create', 'edit'
        ]]);

        // Permission Routes
        Route::resource('permission', 'PermissionController', ['except' => [
            'create', 'edit'
        ]]);

        // Team Routes
        Route::resource('team', 'TeamController', [
            'except' => [
                'create', 'edit'
        ]]);

        // Team Role Routes
        Route::resource('team-role', 'TeamRolesController', [
            'except' => [
                'create', 'edit'
        ]]);

        Route::get('team-role/{user}/{team}', 'TeamRolesController@show');

        // Profile Routes
        /*Route::get('profile',                           'ProfileController@index')->name('profile');
        Route::get('profile/create',                    'ProfileController@create')->name('createProfile');
        Route::post('profile',                          'ProfileController@store')->name('storeProfile');
        Route::get('profile/{id}/edit',                 'ProfileController@edit')->name('editProfile');
        Route::put('profile/{id}',                      'ProfileController@update')->name('updateProfile');
        Route::delete('profile/{id}',                   'ProfileController@destroy')->name('destroyProfile');*/

//        // Roles Routes
//        Route::get('role',                              'RoleController@index')->name('role');
//        Route::get('role/create',                       'RoleController@create')->name('createRole');
//        Route::post('role',                             'RoleController@store')->name('storeRole');
//        Route::get('role/{id}/edit',                    'RoleController@edit')->name('editRole');
//        Route::put('role/{id}',                         'RoleController@update')->name('updateRole');
//        Route::delete('role/{id}',                      'RoleController@destroy')->name('destroyRole');
//
//        // Permissions Routes
//        Route::get('permission',                        'PermissionController@index')->name('permission');
//        Route::get('permission/create',                 'PermissionController@create')->name('createPermission');
//        Route::post('permission',                       'PermissionController@store')->name('storePermission');
//        Route::get('permission/{id}/edit',              'PermissionController@edit')->name('editPermission');
//        Route::put('permission/{id}',                   'PermissionController@update')->name('updatePermission');
//        Route::delete('permission/{id}',                'PermissionController@destroy')->name('destroyPermission');
//
//        // Teams Routes
//        Route::get('team',                              'TeamController@index')->name('team');
//        Route::get('team/create',                       'TeamController@create')->name('createTeam');
//        Route::post('team',                             'TeamController@store')->name('storeTeam');
//        Route::get('team/{id}/edit',                    'TeamController@edit')->name('editTeam');
//        Route::put('team/{id}',                         'TeamController@update')->name('updateTeam');
//        Route::delete('team/{id}',                      'TeamController@destroy')->name('destroyTeam');

//        // System Routes
//        Route::get('setting',                           'GeneralSettingController@index')->name('setting');
//        Route::get('setting/create',                    'GeneralSettingController@create')->name('createSetting');
//        Route::post('setting',                          'GeneralSettingController@store')->name('storeSetting');
//        Route::get('setting/{id}/edit',                 'GeneralSettingController@edit')->name('editSetting');
//        Route::put('setting/{id}',                      'GeneralSettingController@update')->name('updateSetting');
//        Route::delete('setting/{id}',                   'GeneralSettingController@destroy')->name('destroySetting');
//
//        // Team Role Routes
//        Route::get('team-role',                         'TeamRolesController@index')->name('teamRole');
//        Route::get('team-role/create',                  'TeamRolesController@create')->name('createTeamRole');
//        Route::post('team-role',                        'TeamRolesController@store')->name('storeTeamRole');
//        Route::get('team-role/{user}/edit/{team}',      'TeamRolesController@edit')->name('editTeamRole');
//        Route::put('team-role/{id}',                    'TeamRolesController@update')->name('updateTeamRole');
//        Route::delete('team-role/{id}',                 'TeamRolesController@destroy')->name('destroyTeamRole');

        // Project Routes
        /*Route::get('project',                           'ProjectController@index')->name('project');
        Route::get('project/create',                    'ProjectController@create')->name('createProject');
        Route::post('project',                          'ProjectController@store')->name('storeProject');
        Route::get('project/{id}/edit',                 'ProjectController@edit')->name('editProject');
        Route::put('project/{id}',                      'ProjectController@update')->name('updateProject');
        Route::delete('project/{id}',                   'ProjectController@destroy')->name('destroyProject');*/

        // Project Category Routes
        /*Route::get('project-category',                  'ProjectCategoryController@index')->name('projectCategory');
        Route::get('project-category/create',           'ProjectCategoryController@create')->name('createProjectCategory');
        Route::post('project-category',                 'ProjectCategoryController@store')->name('storeProjectCategory');
        Route::get('project-category/{id}/edit',        'ProjectCategoryController@edit')->name('editProjectCategory');
        Route::put('project-category/{id}',             'ProjectCategoryController@update')->name('updateProjectCategory');
        Route::delete('project-category/{id}',          'ProjectCategoryController@destroy')->name('destroyProjectCategory');*/

        /*
         *
         * All of the following routes belongs to the issue prefix.
         *
         */

//        Route::prefix('issue')->namespace('Issue')->group(function () {
//
//            // Issue type Routes
//            Route::get('issue-type',                        'TypeController@index')->name('issueType');
//            Route::get('issue-type/create',                 'TypeController@create')->name('createIssueType');
//            Route::post('issue-type',                       'TypeController@store')->name('storeIssueType');
//            Route::get('issue-type/{id}/edit',              'TypeController@edit')->name('editIssueType');
//            Route::put('issue-type/{id}',                   'TypeController@update')->name('updateIssueType');
//            Route::delete('issue-type/{id}',                'TypeController@destroy')->name('destroyIssueType');
//
//
//            // Issue Type Schema Routes
//            Route::get('issue-type-schema',                 'TypeSchemaController@index')->name('issueTypeSchema');
//            Route::get('issue-type-schema/create',          'TypeSchemaController@create')->name('createIssueTypeSchema');
//            Route::post('issue-type-schema',                'TypeSchemaController@store')->name('storeIssueTypeSchema');
//            Route::get('issue-type-schema/{id}/edit',       'TypeSchemaController@edit')->name('editIssueTypeSchema');
//            Route::put('issue-type-schema/{id}',            'TypeSchemaController@update')->name('updateIssueTypeSchema');
//            Route::delete('issue-type-schema/{id}',         'TypeSchemaController@destroy')->name('destroyIssueTypeSchema');
//
//            // Issue Type Resolution Routes
//            Route::get('issue-type-resolution',             'ResolutionController@index')->name('issueTypeResolution');
//            Route::get('issue-type-resolution/create',      'ResolutionController@create')->name('createIssueTypeResolution');
//            Route::post('issue-type-resolution',            'ResolutionController@store')->name('storeIssueTypeResolution');
//            Route::get('issue-type-resolution/{id}/edit',   'ResolutionController@edit')->name('editIssueTypeResolution');
//            Route::put('issue-type-resolution/{id}',        'ResolutionController@update')->name('updateIssueTypeResolution');
//            Route::delete('issue-type-resolution/{id}',     'ResolutionController@destroy')->name('destroyIssueTypeResolution');
//
//            // Workflow Routes
//            Route::get('workflow',                          'WorkflowController@index')->name('workflow');
//            Route::get('workflow/create',                   'WorkflowController@create')->name('createWorkflow');
//            Route::post('workflow',                         'WorkflowController@store')->name('storeWorkflow');
//            Route::get('workflow/{id}/edit',                'WorkflowController@edit')->name('editWorkflow');
//            Route::put('workflow/{id}',                     'WorkflowController@update')->name('updateWorkflow');
//            Route::delete('workflow/{id}',                  'WorkflowController@destroy')->name('destroyWorkflow');
//
//            Route::get('workflow/{id}/configure',           'WorkflowConfigureController@create')->name('configureWorkflow');
//            Route::put('workflow/{id}/configure',           'WorkflowConfigureController@update')->name('updateWorkflowConfiguration');
//
//            // Workflow Schema Routes
//            /*Route::get('workflow-schema',                   'WorkflowSchemaController@index')->name('workflowSchema');
//            Route::get('workflow-schema/create',            'WorkflowSchemaController@create')->name('createWorkflowSchema');
//            Route::post('workflow-schema',                  'WorkflowSchemaController@store')->name('storeWorkflowSchema');
//            Route::get('workflow-schema/{id}/edit',         'WorkflowSchemaController@edit')->name('editWorkflowSchema');
//            Route::put('workflow-schema/{id}',              'WorkflowSchemaController@update')->name('updateWorkflowSchema');
//            Route::delete('workflow-schema/{id}',           'WorkflowSchemaController@destroy')->name('destroyWorkflowSchema');*/
//
//            // Screen Routes
//            Route::get('screen',                            'ScreenController@index')->name('screen');
//            Route::get('screen/create',                     'ScreenController@create')->name('createScreen');
//            Route::post('screen',                           'ScreenController@store')->name('storeScreen');
//            Route::get('screen/{id}/edit',                  'ScreenController@edit')->name('editScreen');
//            Route::put('screen/{id}',                       'ScreenController@update')->name('updateScreen');
//            Route::delete('screen/{id}',                    'ScreenController@destroy')->name('destroyScreen');
//
//            // Screen Configuration Routes
//            Route::get('screen-config',                     'ScreenConfigController@index')->name('screenConfig');
//            Route::get('screen-config/create',              'ScreenConfigController@create')->name('createScreenConfig');
//            Route::post('screen-config',                    'ScreenConfigController@store')->name('storeScreenConfig');
//            Route::get('screen-config/{id}/edit',           'ScreenConfigController@edit')->name('editScreenConfig');
//            Route::put('screen-config/{id}',                'ScreenConfigController@update')->name('updateScreenConfig');
//            Route::delete('screen-config/{id}',             'ScreenConfigController@destroy')->name('destroyScreenConfig');
//
//            // Screen Schema Routes
//            /*Route::get('screen-schema',                     'ScreenSchemaController@index')->name('screenSchema');
//            Route::get('screen-schema/create',              'ScreenSchemaController@create')->name('createScreenSchema');
//            Route::post('screen-schema',                    'ScreenSchemaController@store')->name('storeScreenSchema');
//            Route::get('screen-schema/{id}/edit',           'ScreenSchemaController@edit')->name('editScreenSchema');
//            Route::put('screen-schema/{id}',                'ScreenSchemaController@update')->name('updateScreenSchema');
//            Route::delete('screen-schema/{id}',             'ScreenSchemaController@destroy')->name('destroyScreenSchema');*/
//
//            // Custom Fields Routes
//            Route::get('custom-field',                      'CustomFieldController@index')->name('customField');
//            Route::get('custom-field/create',               'CustomFieldController@create')->name('createCustomField');
//            Route::post('custom-field',                     'CustomFieldController@store')->name('storeCustomField');
//            Route::get('custom-field/{id}/edit',            'CustomFieldController@edit')->name('editCustomField');
//            Route::put('custom-field/{id}',                 'CustomFieldController@update')->name('updateCustomField');
//            Route::delete('custom-field/{id}',              'CustomFieldController@destroy')->name('destroyCustomField');
//
//            // Field Configuration Routes
//            /*Route::get('field-config',                      'FieldConfigController@index')->name('fieldConfig');
//            Route::get('field-config/create',               'FieldConfigController@create')->name('createFieldConfig');
//            Route::post('field-config',                     'FieldConfigController@store')->name('storeFieldConfig');
//            Route::get('field-config/{id}/edit',            'FieldConfigController@edit')->name('editFieldConfig');
//            Route::put('field-config/{id}',                 'FieldConfigController@update')->name('updateFieldConfig');
//            Route::delete('field-config/{id}',              'FieldConfigController@destroy')->name('destroyFieldConfig');*/
//
//            // Issue Status Routes
//            Route::get('issue-status',                            'StatusController@index')->name('issueStatus');
//            Route::get('issue-status/create',                     'StatusController@create')->name('createIssueStatus');
//            Route::post('issue-status',                           'StatusController@store')->name('storeIssueStatus');
//            Route::get('issue-status/{id}/edit',                  'StatusController@edit')->name('editIssueStatus');
//            Route::put('issue-status/{id}',                       'StatusController@update')->name('updateIssueStatus');
//            Route::delete('issue-status/{id}',                    'StatusController@destroy')->name('destroyIssueStatus');
//
//            // Issue Priority Routes
//            Route::get('priority',                          'PriorityController@index')->name('priority');
//            Route::get('priority/create',                   'PriorityController@create')->name('createPriority');
//            Route::post('priority',                         'PriorityController@store')->name('storePriority');
//            Route::get('priority/{id}/edit',                'PriorityController@edit')->name('editPriority');
//            Route::put('priority/{id}',                     'PriorityController@update')->name('updatePriority');
//            Route::delete('priority/{id}',                  'PriorityController@destroy')->name('destroyPriority');
//
//        });

    }); //End Auth Middleware
});