@extends('base')

@section('content')

<form id="update-task" action="/tasks/{{$task['id']}}" method="POST">
    @csrf
    <label>{{$task['name']}}</label>
    <label>{{$task['startTime']}}</label>

    <button type="submit">Finish</button>
</form>

<script>
    (function () {
        const form = document.getElementById('update-task');

        submitForm = function (event) {
            event.preventDefault();
            let date = window.getStringDateNow();

            input = document.createElement("input");
            input.setAttribute('type', "hidden");
            input.setAttribute('name', 'endTime');
            input.setAttribute('value', date);

            form.append(input);
            form.submit();
        };

        form.addEventListener('submit', submitForm);
    })();
</script>

@endsection
