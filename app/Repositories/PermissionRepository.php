<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function all()
    {
        return $this->permission->all();
    }

    public function create(array $data)
    {
        return $this->permission->create($data);
    }

    public function update(array $data, Permission $permission)
    {
        return $permission->update($data);
    }

    public function delete(Permission $permission)
    {
        return $permission->delete();
    }
}
