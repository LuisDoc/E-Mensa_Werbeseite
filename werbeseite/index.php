
<?php
/**
 * Praktikum DBWT. Autoren:
 * Luis, Diniz Do Carmo, 3275829
 * Nilusche, Liyanaarachchi, 3272466
 */
    require "includes/arrays.inc.php";
?>
<!DOCTYPE html>
<html lang=de dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Ihre E-Mensa</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>
<body>

<!-- Section für den Header -->
<?php
    include ("includes/header.inc.php");
?>


<!-- Section für das Image -->
<section>
    <div class = "title_picture">
        <img class = title_picture_itself src="sources/mensa-fh-aachen.jpg"
             alt="">
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
            </tr>
            </thead>
            <tbody>
            <?php
                print_menu();
            ?>
            </tbody>
        </table>
    </div>
</section>
<br>
<br>
<h3><a class ="Emensa_heading" name ="Zahlen">E-Mensa in Zahlen</a></h3>

<img class="dia" src="sources/diagramm.png" alt="diagramm">
<div class="Emensa">
    <?php
        print_emensa();
    ?>
</div>


<div class="Formular" id="Newsletter">
    <h3 class="formtitle"><a name ="Newsletter">Interesse geweckt?  Wir informieren sie!</a></h3>
    <form class="formParagraph" action="newsletter.php" method="post">
        <input class="input" type="text" name="Vorname" value="" placeholder="Vorname" required>
        <input class="input" type="text" name="email" value="" placeholder="Email" required>
        <select class="sel" name="language">
            <option value="Deutsch">Deutsch</option>
            <option value="Englisch">Englisch</option>
        </select><br><br>
        <input type="checkbox" name="datenschutz" required>Den Datenschutzbestimmungen stimme ich zu
        <input class="subm" type="submit" name="Newsletter" value="Zum Newsletter anmelden">

    </form>
    <?php
    if(isset($_GET['error'])){
        if($_GET['error']=="invalidUsername"){
            echo '<p class="errormessage"> Benutzername nicht valide<br></p>';
        }
        if($_GET['error']=="invalidEmail"){
            echo '<p class="errormessage"> Email nicht valide<br> </p>';
        }
        if($_GET['error']=="success"){
            echo '<p class="successmessage"> Anmeldung für den Newsletter erfolgreich<br></p>';
        }
    }

    ?>
</div>
<h3><a name = "Wichtig">Das ist uns wichtig</a></h3>
<section class="wichtig">
    <div>
        <ul class="list">
            <?php
                print_important();
            ?>

        </ul>
    </div>
</section>
<h1>Wir freuen uns auf ihren Besuch!</h1>

<?php
    include("includes/footer.inc.php");
?>

</body>
</html>
