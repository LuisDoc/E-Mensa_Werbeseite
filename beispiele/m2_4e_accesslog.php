<?php
/**
 * Praktikum DBWT. Autoren:
 * Luis, Diniz Do Carmo, 3275829
 * Nilusche, Liyanaarachchi, 3272466
 */
$file = fopen('./accesslog.txt','a');

$browser = $_SERVER['HTTP_USER_AGENT'];
$line = "Datum: ".date('d-m-Y')." Uhrzeit: ".date("H:i")." IP-Adresse: ".$_SERVER['REMOTE_ADDR']." Webbrowser: ".($browser)."\r";
fwrite($file, $line);

fclose($file);
if(isset($_GET['flush'])){
    file_put_contents('./accesslog.txt', "");
}
?>
<!DOCTYPE html>
<html lang="de" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Ihre E-Mensa</title>
</head>
<body>
    <form method="get">
            <input type="submit" value="reset" name="flush">
    </form>
</body>
</html>

