@extends("layouts.app")

@section('title')
    Start
@endsection

@section('content')
    <header>
        Welkom op mijn website over computers<br>
        Nieuws
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
@endsection