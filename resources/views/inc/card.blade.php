<div id="card_{{ $card->id }}" class="card col-3" data-card-id="{{ $card->id }}">
    <h5 class="card-header">{{ $card->title }}</h5>
    <div class="card-body">
        <h5 class="card-title">{{ $card->title }}</h5>
        <p class="card-text">{{ $card->description }}</p>
        <a href="#" class="btn btn-primary">Open</a>
    </div>
</div>
