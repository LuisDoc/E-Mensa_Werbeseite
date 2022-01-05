@extends('layouts.app')

@section('content')
    <h1>Die letzten 30 Bewertungen</h1>
    <div class="speisen_tabelle">
        <table id="menu">
            <thead>
                <tr>
                    <th>Bewertung</th>
                    <th>Bemerkung</th>
                    <th>Author</th>
                    <th>Datum</th>
                    @if (!Auth::Guest())
                        @if (Auth()->User()->admin)
                            <th></th>
                        @endif
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($bewertungen as $bewertung)
                    <tr style="box-shadow: 0px 0px 5px #FFE400;">
                        <td>{{ $bewertung->bewertung }}</td>
                        <td>{{ $bewertung->bemerkung }}</td>
                        <td>{{ $bewertung->user->email }}</td>
                        <td>{{ $bewertung->created_at }}</td>
                        @if (!Auth::Guest())
                            @if (Auth()->User()->admin)
                                <td>
                                    @if ($bewertung->highlighted == 1)
                                        <a class="btn_wunschgericht" href="/highlightBewertung/{{ $bewertung->id }}">
                                            Hervorhebung aufheben
                                        </a>
                                    @else
                                        <a class="btn_wunschgericht" href="/highlightBewertung/{{ $bewertung->id }}">
                                            Hervorheben
                                        </a>
                                    @endif
                                </td>
                            @endif
                        @endif

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
