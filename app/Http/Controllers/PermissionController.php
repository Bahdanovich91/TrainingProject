<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use app\Repositories\PermissionRepository;
use App\Services\PermissionService;

class PermissionController extends Controller
{
    protected $permissionService;
    protected $permissionRepository;

    public function __construct(
        PermissionService $permissionService,
        PermissionRepository $permissionRepository
    ){
        $this->permissionService = $permissionService;
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $permissions = $this->permissionRepository->all();

        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $data = $request->validated();
        $this->permissionService->create($data);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $data = $request->validated();
        $this->permissionService->update($data, $permission);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $this->permissionService->delete($permission);

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully!');
    }
}
