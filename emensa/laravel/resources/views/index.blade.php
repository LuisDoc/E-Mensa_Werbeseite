@extends('layouts.app')

@section('header')
    <section>
        <!-- Basic Grid für Navigationsleiste und Titelbild links-->
        <div class="header">
            <div class="header_left_picture">
                <a href="/">
                    <!-- Logo Verlinkt zur LandingPage-->
                    <img class="fh_logo" src="sources/Logo_FH-Aachen.jpg'" alt="logo">
                </a>

            </div>
            <!--Inneres Grid für Menupunkte -->
            <div class="header_menu_reiter">
                <a href="/#Ankündigungen" class="header_links">Ankündigung</a>
                <a href="/#Speisekarte" class="header_links">Speisen</a>
                <a href="/#Zahlen" class="header_links">Zahlen</a>
                <a href="/#Newsletter" class="header_links">Kontakt</a>
                <a href="/#Wichtig" class="header_links">Wichtig für Uns</a>
            </div>
        </div>
    </section>
@endsection
@section('content')
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
                            <td>Noch kein Bild vorhanden</td>
                            <td></td>
                        </tr>;
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

    <h3><a class="Emensa_heading" name="Zahlen">E-Mensa in Zahlen</a></h3>

    <!-- E-Mensa in Zahlen -->
    <img class="dia" src="sources/diagramm.png" alt="diagramm">
    <div class="Emensa">

    </div>
@endsection


@section('footer')

@endsection
