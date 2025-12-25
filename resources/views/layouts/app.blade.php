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
        <a href="{{ route("home") }}" class="nav-element">Home</a>

        <!--Logic checked via Gemini, but written by me-->
        @auth

            <a href="{{ route("getAccountInfo", ['id' => auth()->id()]) }}" class="nav-element">Profiel</a>

                @if (auth()->user()->isAdmin())
                    <a href="{{route("userManagement")}}" class="nav-element">Beheer</a>
`                @endif

                <form action="{{ route("logout") }}" class="logAction" method="POST">
                    @csrf
                    <input class="nav-element" type="submit" value="logout">
                </form>
            @endauth 

        @guest
            <a href="/login" class="nav-element logAction">Login</a>
        @endguest
        
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>