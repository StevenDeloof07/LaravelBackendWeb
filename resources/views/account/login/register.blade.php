<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreer</title>
</head>
<body>
    <a href="{{ route('home') }}">Terug</a>

    <div>Registreer hier:</div>
    <form action="{{ route("registerAction") }}" method="post" class="register" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Naam:</label>
            <input id="name" type="text" name="name">
        </div>
        <div>
            <label for="email">Mail:</label>
            <input id="email" type="email" name="email">
        </div>

        <div>
            <label for="birthday">Verjaardag</label>
            <input type="date" name="birthday">
        </div>

        <div>
            <label for="password">Wachtwoord:</label>
            <input id="password" type="password" name="password"> 
        </div>
        <div>
            <label for="password_confirmation">Bevestig wachtwoord:</label>
            <input id="password_confirmation" type="password" name="password_confirmation"> 
        </div>
        <br>

        <div>
            <label for="about_me">Vertel wat over jezelf</label><br>
            <input type="text" name="about_me">
        </div>

        <div>
            <label for="profile_picture">Profiel foto (optioneel)</label><br>

            <input type="file" name="profile_picture">
        </div>

        <input type="submit"  id="formSubmit" value="Registreer" disabled="true">
        <div class="error-message" id="feedBackMessage"></div>
    </form>

    Al een account? <a href="{{ route("login") }}">Hier aanmelden</a>
        @vite("resources/js/account.js")

</body>
</html>