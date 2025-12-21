@extends("layouts.app")

@section("title")
    Gebruikerslijst
@endsection

@section("extraHeaders")
    @vite("resources/css/admin.css")
@endsection

@section("content")
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
@endsection