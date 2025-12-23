@extends("layouts.app")

@section("title")
    {{ $data['username'] }}
@endsection

@section("content")
    <table>
        <tr>
            <th>Gebruikersnaam</th><th>Mail</th><th>Verjaardag</th><th>Over...</th>
        </tr>
        <tr>
            <td>
                {{ $data['username'] }}
            </td>
            <td>
                {{ $data['email'] }}
            </td>
            <td>
                {{ $data['birthday'] }}
            </td>
            <td>
                {{ $data['about_me'] }}
            </td>
        </tr>
    </table>
@endsection