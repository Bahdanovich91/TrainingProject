<?php

namespace Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testIndex()
    {
        // Create some roles to be displayed
        $roles = Role::factory()->count(3)->create();

        // Send a GET request to the index page
        $response = $this->get(route('roles.index'));

        // Assert that the response has a 200 status code
        $response->assertStatus(200);

        // Assert that the response view contains the roles' names
        foreach ($roles as $role) {
            $response->assertSee($role->name);
        }
    }

    public function testCreate()
    {
        // Send a GET request to the create page
        $response = $this->get(route('roles.create'));

        // Assert that the response has a 200 status code
        $response->assertStatus(200);

        // Assert that the response view contains the "Create Role" heading
        $response->assertSee('Create Role');
    }

    public function testStore()
    {
        // Generate some fake role data
        $roleData = [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];

        // Send a POST request to the store method with the fake data
        $this->post(route('roles.store'), $roleData);

        // Assert that the role was actually created in the database
        $this->assertDatabaseHas('roles', $roleData);
    }

    public function testShow()
    {
        // Create a role to be displayed
        $role = Role::factory()->create();

        // Send a GET request to the show page for the role
        $response = $this->get(route('roles.show', $role));

        // Assert that the response has a 200 status code
        $response->assertStatus(200);

        // Assert that the response view contains the role's name and description
        $response->assertSee($role->name);
        $response->assertSee($role->description);
    }

    public function testEdit()
    {
        // Create a role to be edited
        $role = Role::factory()->create();

        // Send a GET request to the edit page for the role
        $response = $this->get(route('roles.edit', $role));

        // Assert that the response has a 200 status code
        $response->assertStatus(200);

        // Assert that the response view contains the "Edit Role" heading
        $response->assertSee('Edit Role');
    }

    public function testUpdate()
    {
        // Create a role to be updated
        $role = Role::factory()->create();

        // Generate new data for the role
        $newRoleData = [
            'name' => 'Updated Role Name',
            'description' => 'Updated Role Description',
        ];

        // Send a PUT request to the update method with the new role data
        $this->put(route('roles.update', $role), $newRoleData);

        // Assert that the updated role data is in the database
        $this->assertDatabaseHas('roles', $newRoleData);

        // Assert that the original role data is not in the database
        $this->assertDatabaseMissing('roles', $role->toArray());
    }


    public function testDestroy()
    {
        // Create a role to be deleted
        $role = Role::factory()->create();

        // Send a DELETE request to the destroy method
        $response = $this->delete(route('roles.destroy', $role));

        // Assert that the response redirects to the index page
        $response->assertRedirect(route('roles.index'));

        // Assert that the role was actually deleted from the database
        $this->assertDatabaseMissing('roles', $role->toArray());
    }
}
