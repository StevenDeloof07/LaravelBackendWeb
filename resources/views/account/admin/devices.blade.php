@extends('layouts.app')

@section("extraHeaders")
    @vite('resources/css/admin.css')
@endsection

@section('title')
    Apparaat beheer
@endsection

@section('content')
    @include('layouts.admin.nav')
    <div class="main-info">
        <table>
            <tr>
                <th>Naam</th><th>Uitgekomen in</th><th>Beschrijving</th><th>Foto</th>
            </tr>
            @foreach ($devices as $device)
            <tr>
                <td>{{  $device['name']}}</td>
                <td>{{ $device['release_date'] }}</td>
                <td>{{  $device['description']}}</td>
                <td><img src="{{ asset("storage/" . $device['picture_link']) }} " alt="foto" height="100px"></td>
                
            </tr>
            @endforeach
        </table>
    </div>
    <div class="flex-form">
        <form action="{{ route ('addDevice')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2>Voeg een apparaat toe</h2>
            <div>
                <label for="name">Naam:</label>
                <input type="text" name="name">
            </div>
            <div>
                <label for="release_date">Uitgekomen in:</label>
                <input type="date" name="release_date">
            </div>
            <div>
                <label for="description">Beschrijving</label>
                <input type="text" name="description">
            </div>
            <div>
                <label for="picture">Foto apparaat</label><br>
                <input type="file" name="picture">
            </div>
            <input type="submit" value="Maak aan">
        </form>
        <form action="{{ route('deleteDevice') }}" method="post">
            @csrf
            @method('DELETE')
            <h2>Verwijder apparaat</h2>
            <select name="id">
                @foreach ($devices as $device)
                    <option value="{{ $device['id'] }}">{{ $device['name'] }}</option>
                @endforeach
            </select>
            <input type="submit" value="Verwijder">
        </form>
    </div>
    @session('error')
        <div class="error-message">{{ $value }}</div>
    @endsession
@endsection