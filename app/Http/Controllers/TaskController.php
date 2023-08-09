<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $tasks = $this->service->all();

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $result = $this->service->create($request->all());

        if ($result['success']) {
            return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
        } else {
            return redirect()->back()->withInput()->withErrors($result['errors']);
        }
    }

    public function show($id)
    {
        $task = $this->service->find($id);

        return view('tasks.show', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $result = $this->service->update($task->id, $request->all());

        if ($result['success']) {
            return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        }

        return redirect()->back()->withInput()->withErrors($result['errors']);
    }
}
