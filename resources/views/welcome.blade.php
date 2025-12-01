<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start</title>
</head>
<body>
    <nav>
        <form action="{{ route("logout") }}" method="POST">
            @csrf
            <input type="submit" value="logout">
        </form>
    </nav>
    Welkom op mijn website over computers
</body>
</html>