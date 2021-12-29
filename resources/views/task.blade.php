@extends('base')

@section('content')

@if (!$task['isOpen'])
    <a href="/">Go Home</a>
@endif

<form id="update-task" action="/tasks/{{$task['id']}}" method="POST">
    @csrf

    <div class="form-controls">
        <h2>Task</h2>
        <label>{{$task['name']}}</label><br><br>
        <label class="counter" id="hours">00</label>:<label class="counter" id="minutes">00</label>:<label class="counter" id="seconds">00</label>

        <input type="hidden" id="startTime" value="{{$task['startTime']}}">
        @if ($task['isOpen'])
            <button class="btn" type="submit">Finish</button>
        @else
            <strong>Finished</strong>
        @endif
    </div>
</form>

<script>
    (function () {
        // Submit form
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

        // Count up timer
        const startTime     = document.getElementById("startTime").value;
        const start         = new Date(startTime);
        const now           = new Date(@if (!$task['isOpen']) '{{$task['endTime']}}' @endif);

        var hoursLabel      = document.getElementById("hours");
        var minutesLabel    = document.getElementById("minutes");
        var secondsLabel    = document.getElementById("seconds");
        var totalSeconds    = Math.round(Math.abs(now - start)/1000);

        @if ($task['isOpen'])
            setInterval(setTime, 1000);
        @else
            setTime();
        @endif

        function setTime()
        {
            secondsLabel.innerHTML  = pad(totalSeconds%60);
            minutesLabel.innerHTML  = pad(parseInt(totalSeconds/60)%60);
            hoursLabel.innerHTML    = pad(parseInt(totalSeconds/60/60));
            ++totalSeconds;
        }

        function pad(val)
        {
            var valString = val + "";
            if(valString.length < 2)
            {
                return "0" + valString;
            }
            else
            {
                return valString;
            }
        }
    })();
</script>

@endsection
