@extends("layouts.app")

@section("title")
    {{ $data['username'] }}
@endsection

@section("content")
    <h2>Profiel</h2>
    <div style="border:solid 1px black;width:45%">
        <div style="display:flex;">
            <ul>
                <li>Naam: {{ $data['name'] }}</li>
                <li>Email: {{ $data['email'] }}</li>
                <li>Verjaardag: {{ date("j M", strtotime($data['birthday'])) }}</li>
                <li>Over: {{ $data['about_me'] }}</li>
            </ul>
            <img style="margin-left:20px" src="{{ asset('storage' . $data['picture_link']) }}" height="200px"  alt="profile picture">
        </div>
        
        @if (!empty($data['devices'])) 
        <table style="border-collapse: collapse;">
            <tr ><th style="border:solid 1px black" colspan="2">Favoriete apparaten</th></tr>
            @foreach ($data['devices'] as $favorite)
                <tr>
                    <td style="border:solid 1px black">{{ $favorite['name'] }}</td>
                    <td style="border:solid 1px black"><img src="{{ asset("storage/" . $favorite['picture_link']) }}" height="150px"></td>
                </tr>
            @endforeach
        </table>
        @endif

        <br>
        
        <button id="changeProfile">Profiel aanpassen</button>
        <form id="changeUserForm" style="display:none;" action="{{  route("changeProfile", ['id' => $data['id']]) }}" method="POST">
            @csrf
            @method('PATCH')
            <div>
                <label for="name">Naam:</label>
                <input id="name" type="text" name="name" value="{{ $data['username'] }}">
            </div>
            <div>
                <label for="birthday">Verjaardag</label>
                <input type="date" id="birthday" name="birthday" value="{{ $data['birthday'] }}">
            </div>
            <div>
                <label for="about_me">Extra info</label><br>
                <input type="text" id="about_me" name="about_me" value="{{ $data['about_me'] }}">
            </div>

            <input type="submit" id="submitForm" value="Aanpassen">
            <div class="error-message" id="feedbackMessage" style="display:none">Gelieve alle waarden in te vullen</div>
        </form>
    </div>
    
    @vite(['resources/js/profile.js'])
@endsection