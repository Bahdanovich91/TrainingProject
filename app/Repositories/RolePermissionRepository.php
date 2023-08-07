<?php

namespace App\Repositories;

use App\Models\Role;

class RolePermissionRepository
{
    public function getPermissionsForRole(Role $role)
    {
        return $role->permissions()->orderBy('name')->get();
    }

    public function syncPermissionsForRole(Role $role, $permissions)
    {
        $role->permissions()->sync($permissions);
    }
}
