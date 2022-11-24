<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Data\Repositories\User\EloquentRepository as UserEloquent;
use App\Data\Repositories\User\UserRepository;

use App\Data\Repositories\Role\EloquentRepository as RoleEloquent;
use App\Data\Repositories\Role\RoleRepository;

use App\Data\Repositories\UserRole\EloquentRepository as UserRoleEloquent;
use App\Data\Repositories\UserRole\UserRoleRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton( UserRepository ::class, UserEloquent ::class );
        $this->app->singleton( RoleRepository ::class, RoleEloquent ::class );
        $this->app->singleton( UserRoleRepository ::class, UserRoleEloquent ::class );
    }
}
