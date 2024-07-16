<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Que mail test</title>
</head>

<body>
    @component('mail::message')
    # Task Created

    A new task has been created.

    **Task Name:** {{ $taskName }}

    **Description:** {{ $taskDescription }}

    Thanks,<br>
    {{ config('app.name') }}
    @endcomponent
</body>

</html>