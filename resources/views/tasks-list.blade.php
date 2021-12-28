@extends('base')

@section('content')
<a href="/">Go Home</a>

<div class="mt-3">
    <h2>Tasks list</h2>
    <div class="mt-3">
        <label>Today total time: {{ gmdate("H\h i\m s\s", $totalTimeToday) }}</label>
    </div>

    <div class="task-items">
        <div class="header task-item">
            <label>Name</label>
            <label>Time</label>
        </div>
        @foreach ($tasksList as $task)
        <div class="task-item">
            <label>{{ $task['name'] }}</label>
            <label>{{ $task['totalTime'] }}</label>
        </div>
        @endforeach
    </div>
</div>
@endsection
