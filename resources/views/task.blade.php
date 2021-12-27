<form id="update-task" action="/tasks/{{$task['id']}}" method="POST">
    <label>{{$task['name']}}</label>
    <label>{{$task['startTime']}}</label>

    <button type="submit">Finish</button>
</form>

<script>
    (function () {
        const form = document.getElementById('update-task');

        const getStringDateNow = function () {
            let date = new Date();
            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();
            let hour = date.getHours();
            let minute = date.getHours();
            let seconds = date.getSeconds();

            return `${year}-${month}-${day} ${hour}:${minute}:${seconds}`;
        };

        submitForm = function (event) {
            event.preventDefault();
            let date = getStringDateNow();

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
