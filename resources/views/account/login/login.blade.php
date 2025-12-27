<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <a href="{{ route('home') }}">Terug</a>
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
        <br>
        <div class="check">
            <label for="remember_me">Blijf ingelogd</label>
            <input type="checkbox" name="remember_me">
        </div>

        <input type="submit" value="login">
    </form>

    Nog geen account? <a href="{{ route("registerPage") }}">Registreer hier</a>

    @if (session("error-message"))
        <div class="error-message">{{ session("error-message") }}</div>
    @endif
</body>
</html>