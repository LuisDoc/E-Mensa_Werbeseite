@extends('layouts.app')

@section('content')
    <h1>Meine Bewertung</h1>
    <div class="speisen_tabelle">
        <table id="menu">
            <thead>
                <tr>
                    <th>Bewertung</th>
                    <th>Bemerkung</th>
                    <th>Author</th>
                    <th>Datum</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bewertungen as $bewertung)
                    <tr>
                        <td>{{ $bewertung->bewertung }}</td>
                        <td>{{ $bewertung->bemerkung }}</td>
                        <td>{{ $bewertung->user->email }}</td>
                        <td>{{ $bewertung->created_at }}</td>
                        <td>
                            <a class="btn_wunschgericht" href="/deleteBewertung/{{ $bewertung->id }}">
                                Löschen
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
