@if(Auth::user())
    <ul>
        <li><a href="{{ route('roles.index') }}">Roles</a></li>
        <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
        <li><a href="#">Users</a></li>
        <li><a href="{{ route('tasks.index') }}">Tasks</a></li>
    </ul>
@endif
