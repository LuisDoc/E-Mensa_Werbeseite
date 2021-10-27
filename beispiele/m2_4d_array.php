<?php
/**
 * Praktikum DBWT. Autoren:
 * Luis, Diniz Do Carmo, 3275829
 * Niluschen, Liyanaarachchi, 3272466
 */

$famousMeals= [
    1=> ['name' => 'Currywurst mit Pommes', 'winner' => [2001,2003,2007, 2010, 2020]],
    2=> ['name' => 'Hähnchencrossies mit Praprikareis', 'winner' => [2002,2004,2008]],
    3=> ['name' => 'Spaghetti Bolognese', 'winner' => [2011,2012,2017]],
    4=> ['name' => 'Jägerschnitzel', 'winner' => 2019]
];
?>
<!DOCTYPE html>
<html lang = "de">
<head>
    <meta charset="UTF-8"/>
    <title>Famous Meals</title>
</head>
<body>
    <ol>
        <?php
            $years=[
                   $famousMeals[1]['winner'],
                   $famousMeals[2]['winner'],
                   $famousMeals[3]['winner'],
                   $famousMeals[4]['winner']
            ];

            foreach($years as $element){
                foreach($element as $key => $value){
                    echo "<li>". $value."</li>";
                }
            }
        ?>
    </ol>
</body>
</html>
