<?php

$link = mysqli_connect(
    "localhost",
    "root",
    "",
    "emensawerbeseite",
    3306
);

if (!$link){
    echo "Verbindung fehlgeschlagen: ",mysqli_connect_error();
    exit();
}
//fehler ausgabe
$error = mysqli_error($link);
echo $error;

$sql = "SELECT id, name FROM gericht order by id";
$result = mysqli_query($link, $sql);
if (!$result) {
    echo "Fehler während der Abfrage: ", mysqli_error($link);
    exit();
}
echo '<table class="table table-dark">';
echo "<thead>";
echo "<th>Id</th>";
echo "<th>Name</th>";
echo "</thead><tbody>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>{$row['id']}</td><td style>{$row['name']}</td></tr>";
}
mysqli_free_result($result);
mysqli_close($link);

