<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create | Workhive</title>
</head>

<body>
    <h1>Create a Job</h1>
    <form action="/jobs" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Enter job title...">
        <input type="text" name="description" placeholder="Enter job description...">
        <button type="submit">Submit</button>
    </form>
</body>

</html>
