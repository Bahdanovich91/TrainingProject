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
        $task->update([
            'completed' => $request->completed,
        ]);

        return response()->json(['message' => 'Task updated successfully']);
    }
}
