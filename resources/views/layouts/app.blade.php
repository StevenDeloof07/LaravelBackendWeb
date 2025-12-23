<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title")</title>
    @vite(['resources/css/app.css'])
    @yield("extraHeaders")
</head>
<body>
    <nav>
        <a href="{{ route("logout") }}">Logout</a>

        <a href="{{ route("home") }}">Home</a>

        <!--Logic checked via Gemini, but written by me-->
        @auth
            <a href="{{ route("getAccountInfo", ['id' => auth()->id()]) }}">Profiel</a>

            @if (auth()->user()->isAdmin())
                <a href="{{route("adminManagement")}}">Beheer</a>
            @endif

        @endauth 

        @guest
            <a href="/login">Login</a>
        @endguest
        
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>