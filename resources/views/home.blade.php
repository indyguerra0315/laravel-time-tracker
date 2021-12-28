@extends('base')

@section('content')
<a href="/tasks-list">Time Tracker Summary</a>

<form id="create-task" action="/tasks" method="POST">
    @csrf
    <div class="form-controls">
        <label>New Task</label>
        <input name="name"> <button class="btn" type="submit">Start</button>
    </div>
</form>


<script>
    (function () {
        const form = document.getElementById('create-task');

        submitForm = function (event) {
            event.preventDefault();
            let date = window.getStringDateNow();

            // Add startTime data to form
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
