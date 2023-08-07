@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Permissions</h2>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->description }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
