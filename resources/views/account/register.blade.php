<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreer</title>
</head>
<body>
    Registreer hier:<br>
    <form action="{{ route("registerAction") }}" method="post">
        @csrf
        <div>
            <label for="name">Naam:</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="email">Mail:</label>
            <input type="email" name="email">
        </div>

        <div>
            <label for="password">Wachtwoord:</label>
            <input type="password" name="password"> 
        </div>
        <div>
            <label for="password_confirmation">Bevestig wachtwoord:</label>
            <input type="password" name="password_confirmation"> 
        </div>

        <input type="submit" value="Registreer">
    </form>

    Al een account? <a href="{{ route("login") }}">Login hier</a>
</body>
</html>