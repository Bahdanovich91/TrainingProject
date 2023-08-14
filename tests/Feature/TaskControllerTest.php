<?php

namespace tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private Model $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function testUnauthorizedUserCannotSeeIndex(): void
    {
        $response = $this->get(route('tasks.index'));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertDontSee('tasks.index');
    }

    public function testIndex(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('tasks.index');
        $response->assertViewHas('tasks');
    }

    public function testCreate(): void
    {
        $title = $this->faker->unique()->word();
        $description = $this->faker->unique()->text();

        $response = $this->actingAs($this->user)->post(route('tasks.store', [
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
        $task = Task::factory()->create();

        $response = $this->actingAs($this->user)->get(route('tasks.show', $task->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('tasks.show');
        $response->assertViewHas('task');
    }

    public function testUpdate(): void
    {
        $task = Task::factory()->create();

        $newTaskData = [
            'title' => 'Updated Task Title',
            'description' => 'Updated Task Description',
        ];

        $this->actingAs($this->user)->put(route('tasks.update', $task), $newTaskData);

        $this->assertDatabaseHas('tasks', $newTaskData);
        $this->assertDatabaseMissing('tasks', $task->toArray());
    }
}
