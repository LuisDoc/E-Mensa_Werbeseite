
<?php
/**
 * Praktikum DBWT. Autoren:
 * Luis, Diniz Do Carmo, 3275829
 * Nilusche, Liyanaarachchi, 3272466
 */
    require "includes/arrays.inc.php";
    session_start();
    if(!isset($_SESSION['token'])){
        $_SESSION['token']=bin2hex(random_bytes(45));
    }
    
    if(isset($_SESSION["userid"])){
        echo "<h1>Angemeldet als: " . $_SESSION['useremail']. " </h1>";
    }

?>
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

<!-- Section für den Header -->
<!-- Der Header wird über die head.inc.php dargestellt-->
<?php
    include ("includes/header.inc.php");
?>

<!-- Section für das Image -->
<section>
    <!-- Div für das Image-->
    <div class = "title_picture">
        <!-- Sollte das Image nicht verfügbar sein, wird alt angezeigt-->
        <img class = title_picture_itself src="sources/mensa-fh-aachen.jpg"
             alt="Picture not found">
    </div>
   
</section>

<!-- Section für Ankündigungen -->
<section>
    <h3 class = ankuendigungen_heading>
        
        <a name ="Ankündigungen">Bald gibt es Essen auch online :)</a>
    </h3>
    <div class ="ankuendigungen_text">
        <div class ="ankuendigungen_text_field">
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
            sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
            sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
            Stet clita kasd gubergren,
            no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
            sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
            accusam et justo duo dolores et ea rebum.
            Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
        </div>
    </div>
</section>

<!-- Section für Speisen -->
<section>
    <h3 class = "speisen_heading">
        <a name ="Speisekarte">Köstlichkeiten, die Sie erwarten</a>
    </h3>
    <!-- Anlegen einer Tabelle -->
    <div class ="speisen_tabelle">
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
            <?php
            //In der Print_Menu werden die einzelnen Zeilen der Tabelle ausgegeben
            print_menu();
            //Die Print Menu with Databse ruft Daten von der Datenbank ab und returned ein Array mit vorkommenden
            //Allergenen
            $usedAllergen = print_menu_with_database();
            ?>
            </tbody>
        </table>
    </div>
    <div class ="speisen_allergene">
        <table id="allergene">
            <thead>
            <tr>
                <th>Code</th>
                <th>Allergene</th>
            </tr>
            </thead>
            <tbody>
                <?php
                //Die oben berechneten Allergene werden jetzt über die funktion printAllergen, ähnlich wie oben,
                //Zeile für Zeile über die Methode berechnet.
                printAllergen($usedAllergen);
                ?>
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
        <a class ="btn_wunschgericht" href="wunschgerichte.php">
            Anfragen!
        </a>
    </div>

</section>
<h3><a class ="Emensa_heading" name ="Zahlen">E-Mensa in Zahlen</a></h3>

<!-- E-Mensa in Zahlen -->
<img class="dia" src="sources/diagramm.png" alt="diagramm">
<div class="Emensa">
    <?php
        //Die E-Mensa in Zahlen wird durch die Funktion print_emensa abgebildet
        print_emensa();
    ?>
</div>

<!-- Formular Newsletteranmeldung -->
<div class="Formular" id="Newsletter">
    <h3 class="formtitle"><a name ="Newsletter">Interesse geweckt?  Wir informieren sie!</a></h3>
    <!-- Form für die Newsletteranmeldung, Daten werden über post an newsletter.php geschickt und dort verarbeitet-->
    <form class="formParagraph" action="newsletter.php" method="post">
        <input class="input" type="text" name="Vorname" value="" placeholder="Vorname" required>
        <input class="input" type="text" name="email" value="" placeholder="Email" required>

        <select class="sel" name="language">
            <option value="Deutsch">Deutsch</option>
            <option value="Englisch">Englisch</option>
        </select><br><br>
        <input type="checkbox" name="datenschutz" required>Den Datenschutzbestimmungen stimme ich zu
        <input class="subm" type="submit" name="Newsletter" value="Zum Newsletter anmelden">
        <?php
        echo '<input type="hidden" name="CSRFtoken" value ="'.$_SESSION['token'].'">';
        ?>
    </form>
    <?php
    //Sollte ein Error existieren ist entweder das Passwort oder die Email falsch
    if(isset($_GET['error'])){
        //Wenn der error invalidUsername entspricht:
        if($_GET['error']=="invalidUsername"){
            //Eine Fehlernachricht wird ausgegeben
            echo '<p class="errormessage"> Benutzername nicht valide<br></p>';
        }
        //Wenn der error invalidEmail entspricht
        if($_GET['error']=="invalidEmail"){
            //Eine Fehlernachricht wird ausgegeben
            echo '<p class="errormessage"> Email nicht valide<br> </p>';
        }
        //Wenn der error Success entspricht
        if($_GET['error']=="success"){
            //Eine Nachricht wird ausgegeben, um die erfolgreiche Anmeldung zu bestätigen
            echo '<p class="successmessage"> Anmeldung für den Newsletter erfolgreich<br></p>';
        }
        if($_GET['error'] == "tokennotexisting"){
            echo '<p class="errormessage"> Method Not Allowed: Token existiert nicht<br></p>';
        }
        if($_GET['error'] == "tokennotexisting"){
            echo '<p class="errormessage"> Method Not Allowed: Token sind nicht identisch<br></p>';
        }
    }
    ?>

</div>

<!-- Das ist uns wichtig -->
<h3><a name = "Wichtig">Das ist uns wichtig</a></h3>
<section class="wichtig">
    <div>
        <ul class="list">
            <?php
                //"Das ist uns wichtig" wird über print_improtant() in einer unsorted List ausgegeben.
                print_important();
            ?>
        </ul>
    </div>
</section>
<h1>Wir freuen uns auf ihren Besuch!</h1>

<!-- Footer -->
<?php
    //Der Footer wird über die hier inkludierte Datei dargestellt
    include("includes/footer.inc.php");
?>

</body>
</html>
