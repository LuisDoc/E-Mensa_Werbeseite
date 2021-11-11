<!DOCTYPE html>
<html lang=de dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Ihre E-Mensa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>
<body>
<?php

$link = mysqli_connect(
    "localhost",
    "root",
    "",
    "emensawerbeseite",
    3307
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
echo "</tbody></table>";

mysqli_free_result($result);
mysqli_close($link);

?>

</body>
</html>
