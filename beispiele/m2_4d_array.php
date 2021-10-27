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
            foreach($famousMeals as $key => $value){
                foreach($value as $element=>$val){
                    echo "<li> ". (string) $val;
                    foreach($val as $val2 => $val3){
                        echo " ". $val3. " ";
                    }
                    echo "</li>";
                }
            }
        ?>
    </ol>
</body>
</html>
