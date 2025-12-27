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
                    <h2 class="{{ $newsitem['id'] }}">{{ $newsitem['title'] }}</h2>
                    <img src="{{ asset("storage" . $newsitem['picture_link']) }}" height="256px" class="{{ $newsitem['id'] }}" alt="nieuws foto">
                    <div class="{{ $newsitem['id'] }}">
                        {{ $newsitem['content'] }}
                    </div>

                    <form action="{{ route('removeNewsItem', $newsitem['id']) }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="submit" value="verwijder">
                    </form>

                    <button id="{{ $newsitem['id'] }}" class="changeBtn">Pas aan</button>
                </li>
            @endforeach
        </table>
    </div>
    <div class="flex-form">
        <form action="{{ route('addNewsItem') }}"  id="addItem" method="POST"  enctype="multipart/form-data">
            @csrf
            <h2>Voeg een nieuwtje toe</h2>
            <div>
                <label for="title">Titel</label>
                <input type="text" name="title" class="add-input">
            </div>

            <div>
                <label for="profile_picture">Nieuwsfoto</label>
                <input type="file" name="profile_picture" class="add-input">
            </div>

            <div>
                <label for="content">Nieuws content</label>
                <input type="text" name="content" class="big-text add-input">
            </div>

            <input type="submit" id='submit' disabled value="voeg toe">
            @session("error") 
                <div class="error-message">{{ $value }}</div>
            @endsession
        </form>

        <!--Form for changing a news item-->
        <form action="{{ route('changeNewsItem') }}" method="POST" id="changeItem" style="display: none;" enctype="multipart/form-data">
            @csrf 
            @method('PATCH')
            <h2>Pas dit item aan</h2>
            <div>
                <label for="title">Titel</label>
                <input type="text" name="title" id="changeTitle" class="change-input">
            </div>

            <div>
                <label for="profile_picture">Nieuwsfoto</label>
                <input type="file" name="profile_picture">
            </div>

            <div>
                <label for="content">Nieuws content</label>
                <input type="text" name="content" id="changeContent"class=" big-text change-input">
            </div>

            <input type="hidden" name="id" id="user_id">

            <input type="submit" id='submitChange' value="Pas aan">

            <button type="button" id="cancelChange">Annuleer</button>
        </form>
    </div>
</div>
@endsection

@section("scripts")
    @vite('resources/js/news.js')
@endsection
