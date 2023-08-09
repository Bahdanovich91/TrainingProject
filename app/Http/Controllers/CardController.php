<?php

namespace App\Http\Controllers;

use App\Services\CardService;
use Illuminate\Http\Request;

class CardController extends Controller
{
    private $service;

    public function __construct(CardService $service)
    {
        $this->service = $service;
    }

    public function index($id)
    {
        $cards = $this->service->all($id);

        return view('cards.index', compact('cards'));
    }

    public function store(Request $request, $taskId)
    {
        $result = $this->service->create($request->all());

        if ($result['success']) {
            return redirect()->route('tasks.show', $taskId)->with('success', 'Card created successfully.');
        } else {
            return redirect()->back()->withInput()->withErrors($result['errors']);
        }
    }

    public function update(Request $request, string $taskId, string $id)
    {
        $result = $this->service->update($id, $request->all());

        if ($result['success']) {
            return redirect()->route('cards.index')->with('success', 'Card updated successfully.');
        }

        return redirect()->back()->withInput()->withErrors($result['errors']);
    }

    public function create(Request $request)
    {
        //
    }

    public function delete(int $id)
    {
        //
    }
}
