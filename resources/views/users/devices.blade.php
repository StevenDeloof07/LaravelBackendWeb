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
@endsection