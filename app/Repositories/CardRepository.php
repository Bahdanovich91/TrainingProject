<?php

namespace App\Repositories;

use App\Models\Card;

class CardRepository
{
    protected $model;

    public function __construct(Card $model)
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
        $card = $this->model->find($id);
        $card->update($data);
        return $card;
    }

    public function delete(int $id)
    {
        $this->model->destroy($id);
    }
}
