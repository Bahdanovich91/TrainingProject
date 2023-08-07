<?php

namespace App\Services;

use App\Models\Permission;
use App\Repositories\PermissionRepository;

class PermissionService
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function all()
    {
        return $this->permissionRepository->all();
    }

    public function create(array $data)
    {
        return $this->permissionRepository->create($data);
    }

    public function update(array $data, Permission $permission)
    {
        return $this->permissionRepository->update($data, $permission);
    }

    public function delete(Permission $permission)
    {
        return $this->permissionRepository->delete($permission);
    }
}
