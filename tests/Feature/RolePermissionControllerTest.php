<?php

namespace Feature;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolePermissionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the update method correctly updates the role's permissions.
     *
     * @return void
     */
    public function testUpdate()
    {
        // Create a role and some permissions
        $role = Role::factory()->create();
        $permissions = Permission::factory()->count(3)->create();

        // Send a PUT request to the update method with the new permissions
        $response = $this->put(route('role_permissions.update', $role), [
            'permissions' => [$permissions[0]->id, $permissions[1]->id],
        ]);

        // Assert that the response redirects to the role show page
        $response->assertRedirect(route('roles.show', $role));

        // Assert that the role now has the correct permissions attached
        $this->assertEquals(2, $role->permissions->count());
        $this->assertTrue($role->permissions->contains($permissions[0]));
        $this->assertTrue($role->permissions->contains($permissions[1]));
        $this->assertFalse($role->permissions->contains($permissions[2]));
    }
}
