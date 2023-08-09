<div class="container">
    <h1>Create Card</h1>
    <form action="{{ route('cards.store', $task->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" id="task_id" name="task_id" value="{{ $task->id }}">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

<table class="table">
    <thead>
    <tr>
        <th>Block</th>
        <th>To do</th>
        <th>In Progress</th>
        <th>Completed</th>
    </tr>
    </thead>
    <tbody>
    @if($task->cards)
        @foreach ($task->cards as $card)
            <tr>
                <td>
                    <div id="card_{{ $card->id }}" class="card col-3" data-card-id="{{ $card->id }}">
                        <h5 class="card-header">{{ $card->title }}</h5>
                        <div class="card-body">
                            <h5 class="card-title">{{ $card->title }}</h5>
                            <p class="card-text">{{ $card->description }}</p>
                            <a href="#" class="btn btn-primary">Open</a>
                        </div>
                    </div>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
