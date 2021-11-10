<?php

$link = mysqli_connect(
    "127.0.0.1",
    "root",
    "passwort",
    "emensawerbeseite",
    3306
);

if ($link){
    echo "Verbindung fehlgeschlagen: ",mysqli_connect_error();
    exit();
}
//fehler ausgabe
$error = mysqli_error($link);
echo $error;

$sql = "SELECT id, name, beschreibung FROM gericht";
$result = mysqli_query($link, $sql);
if (!$result) {
    echo "Fehler während der Abfrage: ", mysqli_error($link);
    exit();
}
while ($row = mysqli_fetch_assoc($result)) {
    echo '<li>', $row['id'], ':', $row['name'], '</li>';
}
mysqli_free_result($result);
mysqli_close($link);

