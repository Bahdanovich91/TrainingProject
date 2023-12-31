<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'completed',
        'description'
    ];

    public function cards()
    {
        return $this->hasMany(Card::class, 'task_id');
    }
}
