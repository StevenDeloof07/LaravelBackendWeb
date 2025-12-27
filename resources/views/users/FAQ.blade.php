@extends('layouts.app')

@section("extraHeaders")
    @vite('resources/css/FAQ.css')
@endsection

@section("title")
FAQ
@endsection

@section("content")
    <h2>Questions:</h2>
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
@endsection