<!DOCTYPE html>
<html lang=de dir="ltr">

<head>
    <!-- Einstellung Charset -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Titel der Webseite unter Tabs-->
    <title>Ihre E-Mensa</title>
    <!-- Einbindung von Stylesheet und fonts/sources-->
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/adminPanelStyle.css">
    <link rel="stylesheet" href="/css/wunschgericht.css">
    <link rel="stylesheet" href="/css/Aufgabe6.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

</head>

<body>
    <div id="page-container">
        <div id="content-wrap">
        @include('sweetalert::alert')
        @yield('header')
        @yield('main')    
        </div>
        @yield('footer')
    </div>
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

</body>

</html>
