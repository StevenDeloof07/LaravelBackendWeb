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
        <table>
            @foreach ($newsList as $newsitem)
                <li>
                    <h2>{{ $newsitem['title'] }}</h2>
                    <img src="{{ asset("storage" . $newsitem['picture_link']) }}" height="256px" alt="nieuws foto">
                    <div>
                        {{ $newsitem['content'] }}
                    </div>

                    <form action="{{ route('removeNewsItem', $newsitem['id']) }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="submit" value="verwijder">
                    </form>
                </li>
            @endforeach
        </table>
    </div>
    <form action="{{ route('addNewsItem') }}" method="POST" class="flex-form" enctype="multipart/form-data">
        @csrf
        <h2>Voeg een nieuwtje toe</h2>
        <div>
            <label for="title">Titel</label>
            <input type="text" name="title">
        </div>

        <div>
            <label for="profile_picture">Nieuwsfoto</label>
            <input type="file" name="profile_picture">
        </div>

        <div>
            <label for="content">Nieuws content</label>
            <input type="text" class="big-text" name="content">
        </div>

        <input type="submit" id='submit' disabled value="voeg toe">
        @session("error") 
            <div class="error-message">{{ $value }}</div>
        @endsession
    </form>
</div>
@endsection

@section("scripts")
    @vite('resources/js/news.js')
@endsection
