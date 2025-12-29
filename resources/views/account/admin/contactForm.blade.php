@extends('layouts.app')

@section("extraHeaders")
    @vite('resources/css/admin.css')
@endsection

@section('title')
    ContactFormulieren
@endsection

@section('content')
    @include('layouts.admin.nav')
    <div class="main-info">
        <table>
            <tr>
                <th>Mail</th><th>Vraag</th><th>Beantwoord</th><th></th>
            </tr>
            @foreach ($forms as $form)
                <tr>
                    <td>
                        {{ $form['user_email'] }}
                    </td>
                    <td>
                        {{ $form['question'] }}
                    </td>
                    <td>
                        {{ $form['anwsered'] ? "Ja" : "Nee"}}
                    </td>
                    <td>
                        <form action="{{ route('respondToQuestion') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $form['id'] }}">
                            <input type="hidden" name="anwser">
                            <input type="submit" class="anwser" value="Stuur een antwoord">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    @vite('resources/js/contact.js')
@endsection