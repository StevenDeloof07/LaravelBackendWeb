@extends('layouts.app');
@section('title')
    Contacteer ons
@endsection

@section("extraHeaders")
    <style>
        .formContainer {
            height:30%;
            align-items: left;
            border:solid 1px black;
            width:20%;
            margin-left: 40%;
            display: flex;
            flex-direction: column;
        }
        .submitQuestion {
            width: 50%;
        }

        #question {
            height:50%;
        }
    </style>
@endsection

@section('content')
    Contacteer ons!
    <div>
        <form action="{{ route('contactAdmin') }}" class="formContainer" method="post">
        @csrf
        <label for="mail">Uw mail:</label>
        <input type="email" id="user_email" name="user_email">
        <br>
        <label for="question">Welke vraag hebt u voor ons:</label>
        <input type="text" id="question" name="question">
        <input type="submit" class="submitQuestion" value="Stuur uw vraag">

        @session('error')
            <div class="error-message">{{ $value }}</div>
        @endsession
        @session('succes')
            <div>{{ $value }}</div>
        @endsession
    </form>
    </div>
    <script>
        const user_email =document.getElementById('user_email')
        const question =document.getElementById('question')
        
        document.querySelector('form').addEventListener('submit', e => {
            if (user_email.value == '' || question.value == '') {
                e.preventDefault();
                document.querySelector('.error-message').innerHTML = "Geef alle waarden in"
            }
        })
    </script>
@endsection