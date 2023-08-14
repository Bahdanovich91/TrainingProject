<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Validator;

class TaskService
{
    protected $repository;

    public function __construct(TaskRepository $repository)
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
            'title' => 'required|unique:tasks|max:255',
            'description' => 'nullable|max:255',
        ]);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()->all()];
        }

        $task = $this->repository->create($data);

        return ['success' => true, 'data' => $task];
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function update(int $id, array $data)
    {
        $task = $this->repository->update($id, $data);

        return ['success' => true, 'data' => $task];
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);

        return ['success' => true];
    }
}
