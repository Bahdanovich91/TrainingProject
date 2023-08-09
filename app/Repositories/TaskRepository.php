<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    protected $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function update(int $id, array $data)
    {
        $role = $this->model->find($id);
        $role->update($data);
        return $role;
    }

    public function delete(int $id)
    {
        $this->model->destroy($id);
    }
}
