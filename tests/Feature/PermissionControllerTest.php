<?php

namespace Feature;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class PermissionControllerTest extends TestCase
{
//    use RefreshDatabase, WithFaker;
//
//    public function testIndex()
//    {
//        $response = $this->get(route('permissions.index'));
//
//        $response->assertStatus(Response::HTTP_OK);
//        $response->assertViewIs('permissions.index');
//        $response->assertViewHas('permissions');
//    }
//
//    public function testCreate()
//    {
//        $response = $this->get(route('permissions.create'));
//
//        $response->assertStatus(Response::HTTP_OK);
//        $response->assertViewIs('permissions.create');
//    }
//
//    public function testStore()
//    {
//        $permissionData = [
//            'name' => 'test_permission',
//            'description' => 'This is a test permission',
//        ];
//
//        $request = new PermissionRequest($permissionData);
//
//        $response = $this->post(route('permissions.store'), $request->all());
//
//        $response->assertStatus(Response::HTTP_FOUND);
//        $response->assertSessionHasNoErrors();
//        $this->assertDatabaseHas('permissions', $permissionData);
//    }
//
//    public function testUpdate()
//    {
//        $permission = Permission::factory()->create();
//
//        $permissionData = [
//            'name' => 'updated_permission',
//            'description' => 'This is an updated permission',
//        ];
//
//        $request = new PermissionRequest($permissionData);
//
//        $response = $this->put(route('permissions.update', $permission->id), $request->all());
//
//        $response->assertStatus(Response::HTTP_FOUND);
//        $response->assertSessionHasNoErrors();
//        $this->assertDatabaseHas('permissions', $permissionData);
//        $this->assertDatabaseMissing('permissions', $permission->toArray());
//    }
//
//    public function testDestroy()
//    {
//        $permission = Permission::factory()->create();
//
//        $response = $this->delete(route('permissions.destroy', $permission->id));
//
//        $response->assertStatus(Response::HTTP_FOUND);
//        $response->assertSessionHasNoErrors();
//        $this->assertDatabaseMissing('permissions', $permission->toArray());
//    }
}
