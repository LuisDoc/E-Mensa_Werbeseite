@extends('layouts.app')

@section('content')
    <h1>Bewertung</h1>
    <h3>{{ $gericht->name }}</h3>
    @if ($gericht->bildname)
        <img class="bewertungenimage" src="/img/gerichte/{{ $gericht->bildname }}"
            alt="/img/gerichte/00_image_missing.jpg">
    @else
        <img class="bewertungenimage" src="/img/gerichte/00_image_missing.jpg" alt="/img/gerichte/00_image_missing.jpg">
    @endif
    <div class="bewertung">
        @if ($errors->all())
            <?php Alert::error('Fehler', 'Bitte geben Sie eine Bewertung, mit mindestens 5 Zeichen ein.'); ?>
        @endif
        <form action="/sendBewertung/{{ $gericht->id }}" method="get">
            <p class="sternebewertung">
                @csrf
                <input type="radio" id="stern4" name="bewertung" value="4"><label for="stern4" title="4 Sterne"></label>
                <input type="radio" id="stern3" name="bewertung" value="3"><label for="stern3" title="3 Sterne"></label>
                <input type="radio" id="stern2" name="bewertung" value="2"><label for="stern2" title="2 Sterne"></label>
                <input type="radio" id="stern1" name="bewertung" value="1"><label for="stern1" title="1 Stern"></label>
            </p>
            <br><br><br>
            <input type="textfield" name="bemerkung" placeholder="*Bemerkung" required>
            <br><br>
            <input type="submit" name="bestaetigung">
        </form>
    </div>
    <h1>Letzten 30 Bewertungen für dieses Gericht</h1>
    <div class="speisen_tabelle">
        <table id="menu">
            <thead>
                <tr>
                    <th>Bewertung</th>
                    <th>Bemerkung</th>
                    <th>Author</th>
                    <th>Datum</th>
                    @if (Auth()->User()->admin)
                        <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($bewertungen as $bewertung)
                    @if ($bewertung->highlighted)
                        <tr class="box">
                        @else
                        <tr>
                    @endif

                    <td>
                        @for ($i = 0; $i < $bewertung->bewertung; $i++)
                            <p class="sternebewertung">
                                <input type="radio" checked="checked" disabled><label></label>
                            </p>
                        @endfor
                    </td>
                    <td>{{ $bewertung->bemerkung }}</td>
                    <td>{{ $bewertung->user->email }}</td>
                    <td>{{ $bewertung->created_at }}</td>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br><br><br><br><br>
@endsection
