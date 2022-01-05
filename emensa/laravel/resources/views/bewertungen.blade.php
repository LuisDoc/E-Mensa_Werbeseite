@extends('layouts.app')

@section('content')
    <style>
        .box {
            background: #fff;
            padding: 16px 24px;
            position: relative;
            border-radius: 8px;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, .01);
        }

        .box::after {
            position: absolute;
            content: "";
            top: 0;
            left: 0;
            right: 0;
            z-index: -1;
            height: 100%;
            width: 100%;
            transform: scale(0.9) translateZ(0);
            filter: blur(15px);
            background: linear-gradient(to left, #ff5770, #e4428d, #c42da8, #9e16c3, #6501de, #9e16c3, #c42da8, #e4428d, #ff5770);
            background-size: 200% 200%;
            animation: animateGlow 1.25s linear infinite;
        }

        @keyframes animateGlow {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 200% 50%;
            }
        }

    </style>
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
                    <tr class="box">
                        <td>{{ $bewertung->bewertung }}</td>
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
@endsection
