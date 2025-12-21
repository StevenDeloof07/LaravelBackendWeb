<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite("resources/css/admin.css")
</head>
<body>
    Dag {{ $name }}! Dit is een lijst van alle gebruikers.

    <table>
        <tr>
            <th>Naam</th><th>Mail</th><th>Is een Admin</th>
        </tr>

        @foreach ($users as $user)
            <tr>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['isAdmin'] ? "Ja" : "Nee"}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>