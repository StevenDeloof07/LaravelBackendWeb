@extends("layouts.app")

@section("title")
    Nieuwslijst
@endsection

@section("extraHeaders")
    @vite("resources/css/admin.css")
@endsection

@section('content')
<div class="flex-container">
    @include('layouts.admin.nav')
    <div class="main-info">
        @foreach ($newsList as $newsitem)
            <li>
                <h2>{{ $newsitem['title'] }}</h2>
                <img src="{{ asset("storage" . $newsitem['picture_link']) }}" height="256px" alt="nieuws foto">
                <div>
                    {{ $newsitem['content'] }}
                </div>
            </li>
        @endforeach
    </div>
</div>
@endsection