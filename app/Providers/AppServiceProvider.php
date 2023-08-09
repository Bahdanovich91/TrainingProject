<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Task;
use App\Repositories\PermissionRepository;
use App\Repositories\RolePermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\TaskRepository;
use App\Services\PermissionService;
use App\Services\RolePermissionService;
use App\Services\RoleService;
use App\Services\TaskService;
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

        $this->app->bind(TaskService::class, function ($app) {
            return new TaskService(new TaskRepository(new Task()));
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
