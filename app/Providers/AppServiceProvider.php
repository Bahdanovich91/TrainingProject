<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
use App\Repositories\PermissionRepository;
use App\Repositories\RolePermissionRepository;
use App\Repositories\RoleRepository;
use App\Services\PermissionService;
use App\Services\RolePermissionService;
use App\Services\RoleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(PermissionService::class, function ($app) {
            return new PermissionService(new PermissionRepository(new Permission()));
        });

        $this->app->bind(RoleService::class, function ($app) {
            return new RoleService(new RoleRepository(new Role()));
        });

        $this->app->bind(RolePermissionService::class, function ($app) {
            return new RolePermissionService(new RolePermissionRepository());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
