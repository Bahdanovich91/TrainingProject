<?php

namespace App\Http\Controllers;

use App\Services\RolePermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $service;
    protected $rolePermissionService;

    public function __construct(RoleService $service, RolePermissionService $rolePermissionService)
    {
        $this->service = $service;
        $this->rolePermissionService = $rolePermissionService;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->service->all();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = $this->service->create($request->all());

        if ($result['success']) {
            return redirect()->route('roles.index')->with('success', 'Role created successfully.');
        } else {
            return redirect()->back()->withInput()->withErrors($result['errors']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = $this->service->find($id);

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = $this->service->find($id);

        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = $this->service->update($id, $request->all());

        if ($result['success']) {
            return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
        }

        return redirect()->back()->withInput()->withErrors($result['errors']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->service->delete($id);

        if ($result['success']) {
            return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
        }

        return redirect()->back()->withErrors(['Unable to delete role.']);
    }
}
