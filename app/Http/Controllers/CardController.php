<?php

namespace App\Http\Controllers;

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

    public function create(Request $request)
    {
        //
    }

    public function delete(int $id)
    {
        //
    }
}
