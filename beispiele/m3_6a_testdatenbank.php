<?php
//Link ist vom Typ Ressource
$link = mysqli_connect(
    "127.0.0.1", // Host der Datenbank
    "root", // Benutzername zur Anmeldung
    "EXC300tpi", // Passwort zur Anmeldung
    "my_db", // Auswahl der Datenbank
    3306);

if(!$link){
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}
