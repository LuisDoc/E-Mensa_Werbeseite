<!DOCTYPE html>
<html lang=de dir="ltr">

<head>
    <!-- Einstellung Charset -->
    <meta charset="utf-8">
    <!-- Titel der Webseite unter Tabs-->
    <title>Ihre E-Mensa</title>
    <!-- Einbindung von Stylesheet und fonts/sources-->
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/adminPanelStyle.css">
    <link rel="stylesheet" href="/css/allergenStyle.css">
    <link rel="stylesheet" href="/css/announcementsStyle.css">
    <link rel="stylesheet" href="/css/FooterStyle.css">
    <link rel="stylesheet" href="/css/headerStyle.css">
    <link rel="stylesheet" href="/css/importantForUsStyle.css">
    <link rel="stylesheet" href="/css/MensaInNumbersStyle.css">
    <link rel="stylesheet" href="/css/menuStyles.css">
    <link rel="stylesheet" href="/css/newsletterFormularStyles.css">
    <link rel="stylesheet" href="/css/titlePictureStyle.css">
    <link rel="stylesheet" href="/css/wunschgericht.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

</head>

<body>
    <div id="page-container">
        <div id="content-wrap">
            <!--Einbinden der Navigationsleiste -->
            <!-- Basic Grid für Navigationsleiste und Titelbild links-->
            <div class="header">
                <div class="header_left_picture">
                    <a href="/">
                        <!-- Logo Verlinkt zur LandingPage-->
                        <img class="fh_logo" src="{{ asset('sources/Logo_FH-Aachen.jpg') }}" alt="logo">
                    </a>

                </div>
                <!--Inneres Grid für Menupunkte -->
                <div class="header_menu_reiter">
                    <a href="/#Ankündigungen" class="header_links">Ankündigung</a>
                    <a href="/#Speisekarte" class="header_links">Speisen</a>
                    <a href="/#Zahlen" class="header_links">Zahlen</a>
                    <a href="/#Newsletter" class="header_links">Kontakt</a>
                    <a href="/#Wichtig" class="header_links">Wichtig für Uns</a>
                    @if(!Auth::guest())
                    <a href="/signout" class="header_links">Ausloggen</a>
                    @endif
                    
                </div>
            </div>

            @include('sweetalert::alert')

            @yield('content')
        </div>
        <footer id="footer">
            <div class="foot">
                <nav>
                    <span class="footer_links">
                        <a class="affiliates" href="#">(c) e mensa GmbH</a>
                        <a class="affiliates" href="#"> Do Carmo,&nbsp;&nbsp;Liyanaarachchi </a>
                        <a class="affiliates" href="#">Impressum</a>
                    </span>
                    <span class="social">
                        <a href="#"><img class="icon" src="sources/facebook.png" alt="facebook"></a>
                        <a href="#"><img class="icon" src="sources/googlep.png" alt="googleplus"></a>
                        <a href="#"><img class="icon" src="sources/linkedIn.png" alt="linkedIn"></a>
                        <a href="#"><img class="icon" src="sources/twitter.png" alt="twitter"></a>
                    </span>
                </nav>
            </div>
        </footer>
    </div>
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])





</body>

</html>
