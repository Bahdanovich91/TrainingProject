@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role: {{ $role->name }}</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $role->name }}</h5>
                <p class="card-text">{{ $role->description }}</p>
            </div>
        </div>
        <h2>Permissions</h2>
        <a href="{{ route('role_permissions.edit', $role->id) }}" class="btn btn-warning mb-3">Edit Permissions</a>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($role->permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->description }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No permissions assigned to this role.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
