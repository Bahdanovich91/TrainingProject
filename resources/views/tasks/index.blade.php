@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Task Board</h1>
        <form action="{{ route('tasks.store') }}" method="post">
            @csrf
            <input type="text" name="title" placeholder="New Task">
            <button type="submit">Add Task</button>
        </form>
        <div class="task-list" id="task-list">
            @foreach ($tasks as $task)
                <div class="task">
                    <label>
                        <input type="checkbox" class="task-checkbox"
                               data-task-id="{{ $task->id }}" {{ $task->completed ? 'checked' : '' }}>
                        <a href="#">{{ $task->title }}</a>
                    </label>
                </div>
            @endforeach

            <script>
                const taskCheckboxes = document.querySelectorAll('.task-checkbox');

                taskCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function () {
                        const taskId = this.dataset.taskId;
                        const completed = this.checked;

                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        axios({
                            method: 'put',
                            url: `/tasks/${taskId}`,
                            data: {
                                completed: completed,
                            },
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        })
                            .then(response => {
                                console.log(response.data.message);
                            })
                            .catch(error => {
                                console.error('Error updating task:', error);
                            });
                    });
                });
            </script>
        </div>
    </div>
@endsection
