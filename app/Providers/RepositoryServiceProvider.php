<?php

namespace App\Providers;

use App\Repositories\Contracts\GeneralSettingsRepository;
use App\Repositories\Contracts\Issue\CustomFieldRepository;
use App\Repositories\Contracts\Issue\PriorityRepository;
use App\Repositories\Contracts\Issue\ResolutionRepository;
use App\Repositories\Contracts\Issue\ScreenConfigRepository;
use App\Repositories\Contracts\Issue\ScreenRepository;
use App\Repositories\Contracts\Issue\StatusRepository;
use App\Repositories\Contracts\Issue\TypeRepository;
use App\Repositories\Contracts\Issue\TypeSchemeRepository;
use App\Repositories\Contracts\Issue\WorkflowRepository;
use App\Repositories\Contracts\PermissionRepository;
use App\Repositories\Contracts\ProjectRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\TeamRepository;
use App\Repositories\Contracts\TeamRolesRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Eloquent\EloquentGeneralSettingsRepository;
use App\Repositories\Eloquent\EloquentPermissionRepository;
use App\Repositories\Eloquent\EloquentProjectRepository;
use App\Repositories\Eloquent\EloquentRoleRepository;
use App\Repositories\Eloquent\EloquentTeamRepository;
use App\Repositories\Eloquent\EloquentTeamRolesRepository;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\Repositories\Eloquent\Issue\EloquentCustomFieldRepository;
use App\Repositories\Eloquent\Issue\EloquentPriorityRepository;
use App\Repositories\Eloquent\Issue\EloquentResolutionRepository;
use App\Repositories\Eloquent\Issue\EloquentScreenConfigRepository;
use App\Repositories\Eloquent\Issue\EloquentScreenRepository;
use App\Repositories\Eloquent\Issue\EloquentStatusRepository;
use App\Repositories\Eloquent\Issue\EloquentTypeRepository;
use App\Repositories\Eloquent\Issue\EloquentTypeSchemeRepository;
use App\Repositories\Eloquent\Issue\EloquentWorkflowRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(RoleRepository::class, EloquentRoleRepository::class);
        $this->app->bind(TeamRepository::class, EloquentTeamRepository::class);
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(PermissionRepository::class, EloquentPermissionRepository::class);
        $this->app->bind(GeneralSettingsRepository::class, EloquentGeneralSettingsRepository::class);
        $this->app->bind(TeamRolesRepository::class, EloquentTeamRolesRepository::class);
        $this->app->bind(ProjectRepository::class, EloquentProjectRepository::class);
        $this->app->bind(TypeRepository::class, EloquentTypeRepository::class);
        $this->app->bind(TypeSchemeRepository::class, EloquentTypeSchemeRepository::class);
        $this->app->bind(StatusRepository::class, EloquentStatusRepository::class);
        $this->app->bind(ResolutionRepository::class, EloquentResolutionRepository::class);
        $this->app->bind(CustomFieldRepository::class, EloquentCustomFieldRepository::class);
        $this->app->bind(PriorityRepository::class, EloquentPriorityRepository::class);
        $this->app->bind(ScreenRepository::class, EloquentScreenRepository::class);
        $this->app->bind(ScreenConfigRepository::class, EloquentScreenConfigRepository::class);
        $this->app->bind(WorkflowRepository::class, EloquentWorkflowRepository::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
