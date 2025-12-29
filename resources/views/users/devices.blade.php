@extends('layouts.app')

@section('title')
    Apparaten
@endsection

@section('extraHeaders')
    @vite('resources/css/guest.css')
@endsection

@section('content')
    <h2>Apparaten die ik graag heb</h2>
    <table>
        <tr>
            <th>Naam</th><th>Uitgekomen in</th><th>Beschrijving</th><th>Foto</th>
            @auth
                <th>Favoriet</th>
            @endauth
        </tr>
        @foreach ($devices as $device)
        <tr>
            <td>{{  $device['name']}}</td>
            <td>{{ $device['release_date'] }}</td>
            <td>{{  $device['description']}}</td>
            <td><img src="{{ asset("storage/" . $device['picture_link']) }} " alt="foto" height="100px"></td>
            @auth
                <td>
                    @if(!$device->favorite(auth()->id()))
                        <form action="{{ route('favoriteDevice') }}" method="post">
                            @csrf
                            <input type="hidden" name="device_id" value="{{ $device['id'] }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id() }}">
                            <input type="submit" value="Maak favoriet">
                        </form>
                    @else 
                        <form action="{{ route('removeFavorite') }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="device_id" value="{{ $device['id'] }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id() }}">
                            <input style="color:red" type="submit" value="Verwijder favoriet">
                        </form>
                    @endif
                </td>
            @endauth
        </tr>
        @endforeach
    </table>
@endsection