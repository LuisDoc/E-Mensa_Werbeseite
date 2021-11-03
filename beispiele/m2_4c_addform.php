<?php
/**
 * Praktikum DBWT. Autoren:
 * Luis, Diniz Do Carmo, 3275829
 * Nilusche, Liyanaarachchi, 3272466
 */
require_once "m2_4a_standardparameter.php";

$result = 0;
if(isset($_GET['addieren'])){
    $result = add($_GET['number_a'],$_GET['number_b']);
}
if(isset($_GET['multiplizieren'])){
    $result = mult($_GET['number_a'],$_GET['number_b']);
}

?>
<!DOCTYPE html>
<html lang = "de">
    <head>
        <meta charset="UTF-8"/>
        <title>ADD Forum</title>
        <style type="text/css">
            * {
                font-family: Arial, serif;
            }
            .rating {
                color: darkgray;
            }
        </style>
    </head>
    <body>
        <form method = "get">
            <input type = "text" name ="number_a" placeholder ="Erste Nummer" required>
            <input type ="text" name ="number_b" placeholder = "Zweite Nummer" required>
            <input type = "submit" name = "addieren" value = "Addieren">
            <input type = "submit" name = "multiplizieren" value="Multiplizieren">
        </form>
        <p> Ergebnis: <?php echo $result ?> </p>
    </body>
</html>

