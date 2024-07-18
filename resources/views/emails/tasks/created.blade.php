<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Sending Using SMTP JOBS & Queue.</title>
</head>

<body>
    <h1>Welcome Email</h1>
    <br>
    <p>Thanks for your task submission:</p>
    <p><strong>Title:</strong> {{ $task->title }}</p>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>Email:</strong> {{ $task->email }}</p>
</body>

</html>
