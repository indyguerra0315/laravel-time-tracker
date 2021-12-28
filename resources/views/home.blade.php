@extends('base')

@section('content')
<form id="create-task" action="/tasks" method="POST">
    @csrf
    <label>Start Task</label><input name="name">

    <button type="submit">Start</button>
</form>

<a href="/tasks-list">Time Tracker Summary</a>

<script>
    (function () {
        const form = document.getElementById('create-task');

        submitForm = function (event) {
            event.preventDefault();
            let date = window.getStringDateNow();

            inputStartTime = document.createElement("input");
            inputStartTime.setAttribute('type', "hidden");
            inputStartTime.setAttribute('name', 'startTime');
            inputStartTime.setAttribute('value', date);
            form.append(inputStartTime);

            inputUuid = document.createElement("input");
            inputUuid.setAttribute('type', "hidden");
            inputUuid.setAttribute('name', 'id');
            inputUuid.setAttribute('value', window.generateUuid());
            form.append(inputUuid);

            form.submit();
        };

        form.addEventListener('submit', submitForm);
    })();
</script>
@endsection
