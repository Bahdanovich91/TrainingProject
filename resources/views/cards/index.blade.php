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
                    @if($card->status == 0)
                        @include('inc.card')
                    @endif
                </td>
                <td>
                    @if($card->status == 1)
                        @include('inc.card')
                    @endif
                </td>
                <td>
                    @if($card->status == 2)
                        @include('inc.card')
                    @endif
                </td>
                <td>
                    @if($card->status == 3)
                       @include('inc.card')
                    @endif
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

<script>
    $(function () {
        $(".card").draggable({
            helper: "clone",
            revert: "invalid",
            cursor: "move",
        });

        $("td").droppable({
            accept: ".card",
            drop: function (event, ui) {
                var cardId = ui.draggable.data("card-id");
                var targetColumn = $(this).index();
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                $.ajax({
                    url: "/cards/update-status",
                    method: "POST",
                    data: {cardId: cardId, targetColumn: targetColumn},
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    success: function (response) {
                        console.log("Card status updated successfully");
                        location.reload();
                    },
                    error: function (error) {
                        console.error("Error updating card status");
                    }
                });
            }
        });
    });
</script>
