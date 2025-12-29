@extends("layouts.app")

@section('title')
    Start
@endsection

@section('content')
    <header>
        Welkom op mijn website over computers<br>
        <h2>Nieuws</h2>
    </header>
    <ul>
        @foreach ($newsList as $newsitem)
            <li>
                <h2>{{ $newsitem['title'] }}</h2>
                <img src="{{ asset("storage" . $newsitem['picture_link']) }}" height="256px" alt="nieuws foto">
                <div>
                    {{ $newsitem['content'] }}
                </div>
            </li>
        @endforeach
    </ul>

    @session('message')
        <div>{{ $value }}</div>
    @endsession
@endsection