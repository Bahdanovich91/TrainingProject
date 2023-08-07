<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\Role;
use App\Repositories\RolePermissionRepository;

class RolePermissionService
{
    protected $rolePermissionRepository;

    public function __construct(RolePermissionRepository $rolePermissionRepository)
    {
        $this->rolePermissionRepository = $rolePermissionRepository;
    }

    public function getPermissionsForRole(Role $role)
    {
        return $this->rolePermissionRepository->getPermissionsForRole($role);
    }

    public function syncPermissionsForRole(Role $role, array $permissions)
    {
        $permissions = collect($permissions)->filter();
        $permissionIds = $permissions->map(function ($permission) {
            return is_numeric($permission) ? $permission : (int)str_replace('permission_', '', $permission);
        })->toArray();

        $permissionModels = Permission::findMany($permissionIds);

        $this->rolePermissionRepository->syncPermissionsForRole($role, $permissionModels);
    }
}
