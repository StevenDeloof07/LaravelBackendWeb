@extends("layouts.app")

@section("title")
    Gebruikerslijst
@endsection

@section("extraHeaders")
    @vite("resources/css/admin.css")
@endsection

@section("content")
    Dag {{ $name }}! 

    <div class="flex-container">
        @include('layouts.admin.nav')
        <table class="main-info">
        <tr>
            <th>Naam</th><th>Mail</th><th>Is een Admin</th><th>Acties</th>
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
        <form action="{{ route("admin.createUser") }}" method="POST" class="flex-item register">
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
                <label for="password">Wachtwoord:</label>
                <input id="password" type="password" name="password"> 
            </div>
            <div>
                <label for="password_confirmation">Bevestig wachtwoord:</label>
                <input id="password_confirmation" type="password" name="password_confirmation"> 
            </div>
            
            <div>
                <label for="isAdmin">Admin</label>
                <input type="checkbox" name="isAdmin">
            </div>

            <input type="submit" id="formSubmit" value="Maak account aan">
        </form>
    </div>
    <div id="message">
        @session("message") 
        {{ $value }}
        @endsession
    </div>

    @session("error") 
        <div class="error-message">{{ $value }}</div>
    @endsession
@endsection