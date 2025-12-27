@extends("layouts.app")

@section("title")
    Lijst met vragen
@endsection

@section("extraHeaders")
    @vite("resources/css/admin.css")
    @vite("resources/css/FAQ.css")
@endsection

@section('content')
<div class="flex-container">
    @include('layouts.admin.nav')
    <div class="main-info">
        <ol>
        @foreach ($data as $category)
            <li>
                <h2>{{  $category['name']}}</h2>
                <ul>
                        @foreach ($category['questions'] as $question)
                        <li>
                            <h3>Vraag:</h3>
                            {{ $question['question'] }}
                            <br>
                            <h3>Antwoord:</h3>
                            {{ $question['anwser'] }}
                        </li>
                        @endforeach
                </ul>
            </li>
        @endforeach
    </ol>
    </div>
    <div class="flex-form">
        <form action="{{ route('addCategory') }}" method="post">
            @csrf
            <h2>Categorie toevoegen</h2>
            <label for="name">Naam Category</label>
            <input type="text" name="name">
            <input type="submit" value="Categorie toevoegen">
            @session('error')
                <div class="error-message">{{ $value }}</div>
            @endsession
            @session('message')
                <div>{{ $value }}</div>
            @endsession
        </form>
        <form action="{{ route("addQuestion") }}" method="post">
            @csrf
            <h2>Vraag toevoegen</h2>

            <label for="question">Vraag</label>
            <input type="text" name="question">
            <br>

            <label for="anwser">Antwoord</label>
            <input type="text" name="anwser">

            <br>

            <label for="category_id">Categorie</label>
            <select name="category_id">
                @foreach ($data as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
            <input type="submit" value="toevoegen">
        </form>
        
    </div>
</div>
@endsection