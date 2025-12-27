@extends("layouts.app")

@section("title")
    Gebruikerslijst
@endsection

@section("extraHeaders")
    @vite("resources/css/admin.css")
@endsection

@section("content")
    <div class="flex-container">
        @include('layouts.admin.nav')
        <div class="main-info">
            <table >
            <tr>
                <th>Naam</th><th>Mail</th><th>Is een Admin</th><th>Acties</th>
            </tr>

                @foreach ($users as $user)
                <tr>
                    <td>
                        <a href="{{  route("getAccountInfo", ['id' => $user['id']]) }}">{{ $user['name'] }}</a>
                    </td>
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
        </div>
        <form action="{{ route("admin.createUser") }}" method="POST" class="flex-form register">
            <h4>Maak een account</h4>
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
            <br>
            <div>
                <label for="birthday">Verjaardag</label>
                <input type="date" id="birthday" name="birthday">
            </div>
            <br>
            <div>
                <label for="about_me">Extra info</label><br>
                <input type="text" id="about_me" name="about_me">
            </div>
            
            <div>
                <label for="isAdmin">Admin</label>
                <input type="checkbox" name="isAdmin">
            </div>

            <input type="submit" id="formSubmit" value="Maak account aan" disabled="true">
            <div class="error-message" id="feedBackMessage"></div>
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
    @vite("resources/js/account.js")
@endsection