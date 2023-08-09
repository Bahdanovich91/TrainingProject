<table class="table">
    <thead>
    <tr>
        <th>?</th>
        <th>?</th>
        <th>?</th>
    </tr>
    </thead>
    <tbody>
    @if($task->cards)
        @foreach ($task->cards as $card)
            <tr>
                <td>{{ $card->title }}</td>
                <td>{{ $card->description }}</td>
                <td><a href="{{ route('card.show', ['id' => $card->id]) }}" class="btn btn-primary">Open</a></td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
{{--<div class="card col-3">--}}
{{--    <h5 class="card-header">{{ $task->title }}</h5>--}}
{{--    <div class="card-body">--}}
{{--        <h5 class="card-title">{{ $task->title }}</h5>--}}
{{--        <p class="card-text">{{ $task->description }}</p>--}}
{{--        <a href="#" class="btn btn-primary">Open</a>--}}
{{--    </div>--}}
{{--</div>--}}
