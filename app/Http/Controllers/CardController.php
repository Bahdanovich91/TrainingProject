<?php

namespace App\Http\Controllers;

use App\Models\Card;
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

    public function update(Request $request, $id)
    {
        $result = $this->service->update($id, $request->all());

        if ($result['success']) {
            return response()->json(['message' => 'Card status updated successfully'], 200);
        }

        return redirect()->back()->withInput()->withErrors($result['errors']);
    }

    public function updateCardStatus(Request $request)
    {
        $cardId = $request->input('cardId');
        $targetColumn = $request->input('targetColumn');

        $card = Card::find($cardId);

        if (!$card) {
            return response()->json(['error' => 'Card not found'], 404);
        }
        $card->status = $targetColumn;

        $card->save();

        return response()->json(['message' => 'Card status updated successfully'], 200);
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
