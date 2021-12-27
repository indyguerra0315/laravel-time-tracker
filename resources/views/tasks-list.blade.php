<h2>Listado de tareas</h2>

<ul>
    @foreach ($tasksList as $task)
    <li>
        <span>{{ $task['name'] }}</span>
        <span>{{ $task['totalTime'] }}</span>
    </li>
    @endforeach
</ul>
