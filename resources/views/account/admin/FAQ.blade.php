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
                                <div class="{{ $question['id'] }}">{{ $question['question'] }}</div>
                            <br>
                            <h3>Antwoord:</h3>
                                <div class="{{ $question['id'] }}">{{ $question['anwser'] }}</div>
                            <br>
                            <br>
                            <button class="changeQuestion category{{ $category['id'] }}" id="{{ $question['id'] }}">Pas aan</button>
                            <form class="removeQuestion" action="{{ route('removeQuestion') }}" style="display:inline" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $question['id'] }}">
                                <input type="submit" value="Verwijder">
                            </form>
                        </li>
                        @endforeach
                </ul>
            </li>
        @endforeach
    </ol>
    </div>
    <div class="flex-form">
        <form action="{{ route('addCategory') }}" id="add_category_form" method="post">
            @csrf
            <h2>Categorie toevoegen</h2>
            <label for="name">Naam Category</label>
            <input type="text" id="add_category_name" name="name">
            <input type="submit" value="Categorie toevoegen">
            <div class="error-message" id="add_category_error"></div>
        </form>


        <form action="{{ route('changeCategory') }}" id="change_category_form" method="post">
            <h2>Pas categorie aan</h2>
            @csrf
            @method('PUT')
            <select name="id">
                @foreach ($data as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
            <br>
            <label for="new_name">Nieuwe naam:</label><br>
            <input type="text" id="change_category_name" name="new_name">
            
            <input type="submit" value="Pas aan">
            <div class="error-message" id="change_category_error"></div>
        </form>

        <form action="{{ route('removeCategory') }}" method="POST" id="deleteCategory">
            @csrf
            @method('delete')
            <h2>Verwijder Categorie</h2>
            <select name="id">
                @foreach ($data as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
            <input type="submit" value="Verwijder">
        </form>

        <form action="{{ route("addQuestion") }}" id="add_question_form" method="post">
            @csrf
            <h2>Vraag toevoegen</h2>

            <label for="question">Vraag</label>
            <input type="text" id="add_question" name="question">
            <br>

            <label for="anwser">Antwoord</label>
            <input type="text" id="add_anwser" name="anwser">

            <br>

            <label for="category_id">Categorie</label>
            <select name="category_id">
                @foreach ($data as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
            <input type="submit" value="toevoegen">
            <div class="error-message" id="add_question_error"></div>
        </form>

        <form action="{{ route('changeQuestion') }}" id="changeQuestion" style="display:none" method="post">
            @csrf 
            @method('put')
            <h2>Vraag aanpassen</h2>
            <input type="hidden" name="id" id="changeQuestionId">

            <label for="question">Vraag</label>
            <input type="text" name="question" id="changeQuestionValue">
            <br>

            <label for="anwser">Antwoord</label>
            <input type="text" name="anwser" id="changeAnwserValue">

            <br>

            <label for="category_id">Categorie</label>
            <select name="category_id" id="change_category">
                @foreach ($data as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>

            <input type="submit" value="Aanpassen">
            <div class="error-message" id="change_question_error"></div>
        </form>
        @session('error')
                <div class="error-message">{{ $value }}</div>
            @endsession
            @session('message')
                <div>{{ $value }}</div>
            @endsession
    </div>
</div>
@vite("resources/js/FAQ.js")
@endsection