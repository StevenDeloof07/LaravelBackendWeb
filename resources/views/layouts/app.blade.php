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
        <a href="{{ route("home") }}" >Home</a>

        <!--Logic checked via Gemini, but written by me-->
        @auth

            <a href="{{ route("getAccountInfo", ['id' => auth()->id()]) }}" >Profiel</a>

            @if (auth()->user()->isAdmin())
                <a href="{{route("userManagement")}}" >Beheer</a>
`           @endif
        @endauth

        <a href="/FAQ" >FAQ</a> 

        <a href="/contact">Contact</a>

        @auth
            <form action="{{ route("logout") }}" class="logAction" method="POST">
                @csrf
                <input class="nav-element" type="submit" value="logout">
            </form>
        @endauth 

        @guest
            <a href="/login" class="logAction">Login</a>
        @endguest
    </nav>
    <main>
        @yield('content')
    </main>
    @yield('scripts')
</body>
</html>