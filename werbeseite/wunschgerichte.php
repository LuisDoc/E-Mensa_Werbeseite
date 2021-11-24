<?php
    session_start();
    unset($_SESSION['token']);
    $_SESSION['token']=bin2hex(random_bytes(45));
?>
<!DOCTYPE html>
<head>
    <!-- Einstellung Charset -->
    <meta charset="utf-8">
    <!-- Titel der Webseite unter Tabs-->
    <title>Wunschgericht</title>
    <!-- Einbindung von Stylesheet und fonts/sources-->
    <link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" charset="utf-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
    include ("includes/header.inc.php");
    echo '<div class="container"><h1> Wunschgericht erstellen</h1>';
    //Ausgabe eines Alarms bei Fehlererkennung in Validation

    if(isset($_GET['error'])){
        if($_GET['error'] == "success"){

            echo '<p class="successmessage"> Wunschgericht erfolgreich abgeschickt<br></p>';
        }
        if($_GET['error'] == "invalidName"){
            echo '<p class="errormessage"> Bitte geben Sie einen gültigen Namen ein, oder lassen Sie das Feld leer<br></p>';
        }
        if($_GET['error'] == "invalidEmail"){
            echo '<p class="errormessage"> Die E-Mail Adresse ist fehlerhaft<br></p>';
        }
        if($_GET['error'] == "invalidGerichtname"){
            echo '<p class="errormessage"> Bitte geben Sie einen gültigen Gerichtnamen ein<br></p>';
        }
        if($_GET['error'] == "stmterror"){
            echo '<p class="errormessage"> Statement failed<br></p>';
        }
        if($_GET['error'] == "tokennotexisting"){
            echo '<p class="errormessage"> Method Not Allowed: Token existiert nicht<br></p>';
        }
        if($_GET['error'] == "tokennotexisting"){
            echo '<p class="errormessage"> Method Not Allowed: Token sind nicht identisch<br></p>';
        }
    }
    ?>


        <!-- Eingabemöglichkeiten für ein Wunschgericht-->
        <form method="POST" action="validateWunschgericht.php">
            <input class="form-control "type="text" name="name" placeholder="name">
            <input class="form-control "type="text" name="email" placeholder="email">
            <input class="form-control "type="text" name="gerichtname" placeholder="Gerichtname">
            <textarea rows="5" class="form-control" name="beschreibung" placeholder="Beschreibung"></textarea>
            <?php
                echo '<input type="hidden" name="CSRFtoken" value ="'.$_SESSION['token'].'">';
            ?>


            <button type="submit" name="submit" class="btn btn-warning">Speichern</button>
        </form>


    <h1>Aktuelle Gerichte DEBUG</h1>
    <?php
        $conn= new mysqli('localhost','root','','emensawerbeseite');
        $result= $conn->query("SELECT * from wunschgericht ORDER BY erstellungsdatum desc limit 5");
        echo '<table class="table table-light table-striped">';
        echo '<thead class="table-dark">
                  <th>Ersteller</th>
                  <th>Erstellungdatum</th>
                  <th>Gerichtname</th>
                  <th>Beschreibung</th>
                  </thead>
                  <tbody>';
        while($row=$result->fetch_row()){
            echo "</tr>";
            echo "<td>{$row[2]}</td>";
            echo "<td>{$row[3]}</td>";
            echo "<td>{$row[4]}</td>";
            echo "<td>{$row[5]}</td>";
            echo "</tr>";

        }

        echo"</tbody></table>";



    ?>
    </div>
</body>
