<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vervang wachtwoord</title>
</head>
<body>
    Dag {{ $data['name'] }},<br><br>

    Er is een verzoek ingestuurd om uw wachtwoord te vervangen.<br>
    Indien u dit verzoek niet hebt ingediend, contacteer onmiddelijk de site beheerders.

    <br>
    <br>
    <a href="{{ $data['url'] }}">Klik hier om het aan te passen</a>
</body>
</html>