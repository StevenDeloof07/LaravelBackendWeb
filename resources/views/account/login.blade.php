<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div>Gelieve in te loggen met uw user mail</div>
    <br>
    <form action="{{ route("loginAction") }}" method="POST">
        @csrf
        <div>
            <label for="email">Mail:</label>
            <input type="email" name="email">
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password"> 
        </div>

        <input type="submit" value="login">
    </form>

    Nog geen account? <a href="{{ route("registerPage") }}">Registreer hier</a>
</body>
</html>