@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Task: {{ $task->title }}</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Title: {{ $task->title }}</h5>
                <p class="card-text">Description: {{ $task->description }}</p>
            </div>
        </div>
    </div>
@endsection
