<?php

namespace tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testUnauthorizedUserCannotSeeIndex(): void
    {
        $response = $this->get(route('tasks.index'));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertDontSee('tasks.index');
    }

    public function testIndex(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('tasks.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('tasks.index');
        $response->assertViewHas('tasks');
    }

    public function testCreate(): void
    {
        $user = User::factory()->create();
        $title = $this->faker->unique()->word();
        $description = $this->faker->unique()->text();

        $response = $this->actingAs($user)->post(route('tasks.store', [
            'title' => $title,
            'description' => $description
        ]));

        $this->assertDatabaseHas('tasks', [
            'title' => $title,
            'completed' => false,
            'description' => $description
        ]);
    }

    public function testShow(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create();

        $response = $this->actingAs($user)->get(route('tasks.show', $task->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('tasks.show');
        $response->assertViewHas('task');
    }

    public function testUpdate(): void
    {
        $task = Task::factory()->create();
        $user = User::factory()->create();

        $newTaskData = [
            'title' => 'Updated Task Title',
            'description' => 'Updated Task Description',
        ];

        $this->actingAs($user)->put(route('tasks.update', $task), $newTaskData);

        $this->assertDatabaseHas('tasks', $newTaskData);
        $this->assertDatabaseMissing('tasks', $task->toArray());
    }
}
