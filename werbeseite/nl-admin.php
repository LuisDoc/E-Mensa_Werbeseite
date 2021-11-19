<?php
/**
 * Praktikum DBWT. Autoren:
 * Luis, Diniz Do Carmo, 3275829
 * Nilusche, Liyanaarachchi, 3272466
 */

/*
 * Einlesen aller Registrierungen
 */
$allRegistrations = [];
//Nur wenn das File auch existiert, kann eingelesen werden
if(file_exists("persons.csv")){
    //Das File wird geöffnet
    $file = fopen("persons.csv","r");
    //Solange es noch zeilen gibt, wird weiter eingelesen
    while(! feof($file)) {
        //Zeilen werden eingelesen
        $line = (fgetcsv($file));
        if (!$line)
            break;
        //Und in das Array gepushed
        array_push($allRegistrations,['name'=>$line[0], 'email'=>$line[1], 'language' =>$line[2]]);
    }
    //schließen des Files
    fclose($file);
}
/*
 * Sort
 */
//Sortieren des Arrays über den Key 'Email' wird standardeingestellt
$_SESSION['sortbykey'] = 'email';



?>
<!DOCTYPE html>
<html lang=de dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Ihre E-Mensa</title>
    <!-- Einbettung von Bootstrap Libraries und weiteren Sources -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Newsletter Anmeldungen</h1>
    <div class="dropdown" method="GET">
        <!-- Dropdown Menu, zur Abfrage der Sortierungsart-->
        <form method = get>
            <button class="btn btn-dark dropdown-toggle" style="margin-bottom:5px; border-radius: 0!important;"type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Sortieren nach
            </button>
            <!-- Optionen im Dropdown Menu-->
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><input class="dropdown-item" type=submit name="sortby" value="Name"></input></li>
                <li><input class="dropdown-item" type="submit" name="sortby" value = "Email"></input></li>
            </ul>
        </form>
        <form class="d-flex" method="GET" style="width:20em;margin-bottom:5px;">
            <input class="form-control me-2" name = "searchTerm" type="text" aria-label="Search">
            <button class="btn btn-outline-dark" name = "submit" type="submit">Suchen</button>
        </form>

    </div>
    <!-- Tabelle, in der alle Einträge angezeigt werden-->
    <table class="table table-dark table-striped">
    <thead>
    <th>Name</th>
    <th>E-Mail</th>
    <th>Sprache</th>
    <th>Datenschutz</th>
    </thead>
    <tbody>
    <?php
        /*
         * Filtern
         */
        $displayRegistrations = [];
        //vorher if (!empty($_GET[GET_PARAM_SEARCH_TEXT]) {
        if (!empty($_GET['searchTerm'])) { //Wenn kein suchterm vorhanden ist, wird auch nicht gefiltert
                $searchTerm = "/".$_GET['searchTerm']."/i"; //Automatisches umschreiben in Lower case um Groß und Kleinschreibung vernachlässigen zu können
                foreach ($allRegistrations as $user) { //Für jeden User ausführen
                    $userName = strtolower($user['name']) ;
                    if (preg_match($searchTerm, $userName)) { //Suche nach einem treffer -> ist $userName in $serachTerm ?
                        $displayRegistrations[] =  $user; //Dann füge den User hinzu
                    }
                }
        }
        else{
            //Wenn kein Suchterm sollen alle Registrations angezeigt werden
            $displayRegistrations= $allRegistrations;
        }
        /*
         * Sortieren
         */
        //Wenn Sortby existiert, dann wird der sortkey abhängig von sortby gewechselt
        if(isset($_GET['sortby'])){
            if($_GET['sortby'] =="Name"){
                $_SESSION['sortbykey'] ='name';
            }
            else{
                $_SESSION['sortbykey'] = 'email';
            }
        }
        //Sortierung des arrays abhängig vom SortByKey
        usort($displayRegistrations, function($item1, $item2){
            return strtolower($item1[$_SESSION['sortbykey']]) <=> strtolower($item2[$_SESSION['sortbykey']]);
        });

        //Anzeige aller Registrierungen
        foreach($displayRegistrations as $user){
            echo "<tr>
                <td>{$user['name']}</td>
                <td>{$user['email']}</td>
                <td>{$user['language']}</td>
                <td>Angekreuzt</td>
            </tr>";
        }
    ?>

    </tbody>
    </table>
</body>
</html>


