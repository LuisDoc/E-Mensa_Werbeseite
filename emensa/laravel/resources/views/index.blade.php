@extends('layouts.app')

@section('content')
    <!-- Section für Titelbild-->
    <section>
        <!-- Div für das Image-->
        <div class="title_picture">
            <!-- Sollte das Image nicht verfügbar sein, wird alt angezeigt-->
            <img class=title_picture_itself src="sources/mensa-fh-aachen.jpg" alt="Picture not found">
        </div>
    </section>
    <!-- Section für Ankündigungen -->
    <section>
        <h3 class=ankuendigungen_heading>
            <a name="Ankündigungen">Bald gibt es Essen auch online :)</a>
        </h3>
        <div class="ankuendigungen_text">
            <div class="ankuendigungen_text_field">
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                Stet clita kasd gubergren,
                no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing
                elitr,
                sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero
                eos et
                accusam et justo duo dolores et ea rebum.
                Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            </div>
        </div>
    </section>
    <!-- Section für Speisen -->
    <section>
        <h3 class="speisen_heading">
            <a name="Speisekarte">Köstlichkeiten, die Sie erwarten</a>
        </h3>
        <!-- Anlegen einer Tabelle -->
        <div class="speisen_tabelle">
            <table id="menu">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Preise intern</th>
                        <th>Preise extern</th>
                        <th>Bilder</th>
                        <th>Allergene</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($Gerichte as $gericht)
                        <tr>
                            <td>{{ $gericht->name }}</td>
                            <td>{{ $gericht->preis_intern }}</td>
                            <td>{{ $gericht->preis_extern }}</td>
                            <td> Noch kein Bild vorhanden </td>
                            @if (!empty($AllergeneProGericht[$gericht->id]))
                                <td>{{ $AllergeneProGericht[$gericht->id] }}</td>
                            @else
                                <td> /</td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                        </tr>;
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="speisen_allergene">
            <table id="allergene">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Allergene</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($AlleAllergene as $allergen)
                        <tr>
                            <td>{{ $allergen->code }}</td>
                            <td>{{ $allergen->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td>...</td>
                            <td>...</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <!-- Button zur Webseite zur Gerichterstellung -->
        <h3>
            Ihr Wunschgericht ist nicht dabei ?
        </h3>
        <div class="wrapper">
            <a class="btn_wunschgericht" href="wunschgerichte.php">
                Anfragen!
            </a>
        </div>

    </section>
    <!-- Section für E-Mensa in Zahlen -->
    <section>
        <h3><a class="Emensa_heading" name="Zahlen">E-Mensa in Zahlen</a></h3>
        <!-- E-Mensa in Zahlen -->
        <img class="dia" src="sources/diagramm.png" alt="diagramm">
        <div class="Emensa">
            <div class="grid-mensa"> {{ Session::get('counterViewer') }} Besucher</div>
            <div class="grid-mensa"> {{ $CounterNewsletterAnmeldungen }} Anmeldungen zum Newsletter</div>
            <div class="grid-mensa"> {{ $CounterSpeisen }} Gerichte auf der Speisekarte</div>
        </div>
    </section>
    <!-- Section für Newsletter Anmeldung -->
    <section id="newsletter">
        @forelse ($errors->all() as $error)
                <li class="errormessage">{{ $error }}</li>
        @endforeach
        
        @if(Session::has('success'))
                <li class="successmessage">{{session()->get('success')}}</li>
        @endif
        <form class="formParagraph" action="/SignUpNewsletter" method="post">
            @csrf
            <input class="input" type="text" name="name" value="" placeholder="Name" required>
            <input class="input" type="text" name="email" value="" placeholder="Email" required>

            <select class="sel" name="language">
                <option value="german">Deutsch</option>
                <option value="english">Englisch</option>
            </select><br><br>
            <input type="checkbox" name="datenschutz" required>Den Datenschutzbestimmungen stimme ich zu
            <input class="subm" type="submit" name="Newsletter" value="Zum Newsletter anmelden">
        </form>
    </section>
    <!-- Section für Was uns wichtig ist -->
    <section>
        <h3><a name="Wichtig">Das ist uns wichtig</a></h3>
        <section class="wichtig">
            <div>
                <ul class="list">
                    @foreach ($WasUnsWichtigIst as $important)
                        <li>{{ $important }}</li>
                    @endforeach
                </ul>
            </div>
        </section>
    </section>
@endsection
<?php

?>