@extends('layouts.app')

@section('content')
    <h1>Bewertung</h1>
    <h3>{{ $gericht->name }}</h3>
    <img class="bewertungenimage" src="/img/gerichte/{{ $gericht->bildname }}" alt="/img/gerichte/00_image_missing.jpg">
    <div class="bewertung">
        <form action="/sendBewertung/{{ $gericht->id }}" method="get">
            <p class="sternebewertung">
                @csrf
                <input type="radio" id="stern4" name="bewertung" value="4"><label for="stern4" title="4 Sterne"></label>
                <input type="radio" id="stern3" name="bewertung" value="3"><label for="stern3" title="3 Sterne"></label>
                <input type="radio" id="stern2" name="bewertung" value="2"><label for="stern2" title="2 Sterne"></label>
                <input type="radio" id="stern1" name="bewertung" value="1"><label for="stern1" title="1 Stern"></label>
            </p>
            <br><br><br>
            <input type="textfield" name "bemerkung" placeholder="*Bemerkung" required>
            <br><br>
            <input type="submit" name="bestaetigung">
        </form>
    </div>
    <h1>Letzten 30 Bewertungen</h1>
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
                <tr>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    @if (Auth()->User()->admin)
                        <td>
                            <a class="btn_wunschgericht" href="">
                                Hervorheben
                            </a>
                        </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
@endsection
