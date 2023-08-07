<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolePermissionRequest;
use App\Models\Role;
use app\Services\RolePermissionService;

class RolePermissionController extends Controller
{
    protected $rolePermissionService;

    public function __construct(RolePermissionService $rolePermissionService)
    {
        $this->rolePermissionService = $rolePermissionService;
    }

    public function update(RolePermissionRequest $request, Role $role)
    {
        $this->rolePermissionService->syncPermissionsForRole($role, $request->input('permissions'));
        return redirect()->route('roles.show', $role)->with('success', 'Role permissions updated successfully.');
    }
}
