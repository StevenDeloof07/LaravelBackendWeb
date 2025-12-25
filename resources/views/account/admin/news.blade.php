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
</div>
@endsection