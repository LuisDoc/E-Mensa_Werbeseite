<?php
/**
 * Praktikum DBWT. Autoren:
 * Luis, Diniz Do Carmo, 3275829
 * Nilusche, Liyanaarachchi, 3272466
 */

$famousMeals= [
    1=> ['name' => 'Currywurst mit Pommes', 'winner' => [2001,2003,2007, 2010, 2020]],
    2=> ['name' => 'Hähnchencrossies mit Praprikareis', 'winner' => [2002,2004,2008]],
    3=> ['name' => 'Spaghetti Bolognese', 'winner' => [2011,2012,2017]],
    4=> ['name' => 'Jägerschnitzel mit Pommes', 'winner' => 2019]
];

/*
 * Aufgabenteil b
 */
function calculateMissingYears($famousMeals){

    //Aktuelles jahr
    $recent_year = date("Y");
    //Array mit Ergebnissen
    $result=[];
    //Startjahr ist 2000
    $year = 2000;

    while($year <= $recent_year){
        $gefunden = false;
        foreach ($famousMeals as $meal){
            if(is_array($meal['winner'])){
                foreach($meal['winner'] as $values){
                    if($values === $year){
                        $gefunden = true;
                    }
                }
            }
            else{
                if($meal['winner'] === $year){
                    $gefunden = true;
                }
            }
        }
        if($gefunden === false){
            array_push($result, $year);
        }
        $year++;
    }
    return $result;

}
?>
<!DOCTYPE html>
<html lang = "de">
<head>
    <meta charset="UTF-8"/>
    <title>Famous Meals</title>
    <style>
        .aeußere_liste{
            list-style-type: decimal;
        }
        .innere_liste{
            list-style-type: none;
            margin-left: -40px;
        }
        .listenelement_innen{
            display: inline;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<h1>
    Aufgabenteil a)
</h1>
    <ol>
        <?php
         echo "<ul class = aeußere_liste>";
            foreach ($famousMeals as $meal){
                echo "<li>{$meal['name']} <ol class = innere_liste>";
                //Wenn mehr als ein Jahr eingetragen ist
                if(is_array($meal['winner'])){
                    //Array sortieren nach value
                    arsort($meal['winner']);
                    //Ermittle das wie vielte Objekt gerade ausgegeben wird
                    $counter = 0;
                    //Ermittle Menge an Jahren
                    $amount = count($meal['winner']);
                    foreach($meal['winner'] as $year){
                        echo "<li class = listenelement_innen>{$year}";
                        //Ein weiteres Jahr wurde ausgegeben -> inkrementieren
                        $counter++;
                        //Wenn noch nicht alle Jahre ausgegeben wurde, Kommata setzen
                        if ($amount !== $counter)
                            echo ", ";
                        echo "</li>";
                    }
                }
                //Wenn nur ein Jahr eingetragen ist
                else{
                    echo "<li class = listenelement_innen>".$meal['winner']."</li>";
                }
                //Beenden des Listen Elements: Sortierte Liste
                echo "</ol></li>";
            }
            echo  "</ul>";
        ?>
    </ol>
<h1> Aufgabenteil b)</h1>
    <?php
        echo "<ol class = innere_liste>";
        foreach  (calculateMissingYears($famousMeals) as $year){
            echo "<li>".$year."</li>";
        }
    echo "<o/l>";
    ?>
</body>
</html>
