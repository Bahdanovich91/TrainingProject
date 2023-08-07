<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\Validator;

class RoleService
{
    protected $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function create(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|unique:roles|max:255',
            'description' => 'nullable|max:255',
        ]);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()->all()];
        }

        $role = $this->repository->create($data);

        return ['success' => true, 'data' => $role];
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function update(int $id, array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:255|unique:roles,name,' . $id,
            'description' => 'nullable|max:255',
        ]);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()->all()];
        }

        $role = $this->repository->update($id, $data);

        return ['success' => true, 'data' => $role];
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);

        return ['success' => true];
    }
}
