<!DOCTYPE html>
<html lang=de dir="ltr">

<head>
    <!-- Einstellung Charset -->
    <meta charset="utf-8">
    <!-- Titel der Webseite unter Tabs-->
    <title>Ihre E-Mensa</title>
    <!-- Einbindung von Stylesheet und fonts/sources-->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>

<body>
    <!--Einbinden der Navigationsleiste -->
    @yield('header')

    @yield('content')

    @yield('footer')


</body>

</html>
