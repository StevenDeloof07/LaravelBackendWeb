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
        <form action="{{ route("logout") }}" method="POST">
            @csrf
            <input type="submit" value="logout">
        </form>

        <form action="{{ route("home") }}" method="GET">
            @csrf
            <input type="submit" value="Home">
        </form>

        @if ($isAdmin)

        <form action="{{route("adminManagement")}}" method="GET">
            @csrf
            <input type="submit" value="Beheer">
        </form>

        @endif

        <!--Logic checked via Gemini, but written by me-->
        @auth
            <a href="{{ route("getAccountInfo", ['id' => auth()->id()]) }}">Profiel</a>
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