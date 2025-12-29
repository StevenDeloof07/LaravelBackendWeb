<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verander wachtwoord</title>
    @vite('resources/css/app.css')
</head>
<body>
    <h2>Geef een nieuw wachtwoord in</h2>
    <form action="{{ route('change_pass_action')}}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div>
            <label for="mail">Email:</label><br>
            <input type="email" name="mail">
        </div>
        <div>
            <label for="password">Wachtwoord:</label><br>
            <input type="password" name="password">
        </div>
        <div>
            <label for="password_confirmation">Bevestig wachtwoord:</label><br>
            <input type="password" name="password_confirmation">
        </div>

        <input type="submit" value="Verander wachtwoord">
        @session('error')
            <div class="error-message">{{ $value }}</div>
        @endsession
    </form>
</body>
</html>