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
                <td>
                    <form action="{{ $user['isAdmin'] ? route("removeAdmin", ['id' => $user['id']]) : route("makeAdmin") }}" method="POST">
                        @csrf 
                        @method($user['isAdmin'] ? "DELETE" : "POST")
                        @if(!$user['isAdmin'])
                        <input type="hidden" name="user_id" value="{{ $user['id'] }}">
                        @endif
                        <input type="submit" value="{{ $user['isAdmin'] ? "Verwijder admin rechten" : "Maak admin"}}"> 
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection