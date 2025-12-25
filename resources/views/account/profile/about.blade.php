@extends("layouts.app")

@section("title")
    {{ $data['username'] }}
@endsection

@section("content")
<h2>Profiel</h2>
    <ul>
        <li>Naam: {{ $data['username'] }}</li>
        <li>Email: {{ $data['email'] }}</li>
        <li>Verjaardag: {{ date("j M", strtotime($data['birthday'])) }}</li>
        <li>Over: {{ $data['about_me'] }}</li>
    </ul>
    <img src="{{ asset('storage/' . $data['picture_link']) }}" height="100px" width="100px" alt="profile picture">
@endsection