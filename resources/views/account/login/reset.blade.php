<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wachtwoord vergeten</title>
    @vite('resources/css/app.css')
</head>
<body>
    <form action="{{ route('request_pass_change') }}" method="post">
        @csrf
        <h2>Wachtwoord vergeten?</h2>
        <div>Geef uw mail in, en we sturen een verzoek om het wachtwoord te vervangen.</div>
            <label for="email">Mail:</label>
            <input type="email" name="user_mail">
            <br>
        <input type="submit" value="Stuur Verzoek">
        @session('error')
            <div class="error-message">{{ session('error') }}</div>
        @endsession
        @session('message')
            <div>{{  $value}}</div>
        @endsession
    </form>
</body>
</html>