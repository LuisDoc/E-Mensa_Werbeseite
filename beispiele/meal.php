<?php
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_PARAM_SHOW_DESCRIPTION = 'show_description';

/**
 * List of all allergens.
 */
$allergens = [
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    //vorher 14 => 'Fisch'
    14 => 'Fisch',
    17 => 'Milch'
];

$meal = [
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    //vorher: 'allergens' => [11,13,
    'allergens' => [11, 13],
    'amount' => 42             // Number of available meals
];

$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];
$showRatings = [];
//vorher if (!empty($_GET[GET_PARAM_SEARCH_TEXT]) {
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    //Mit strtolower wird der Suchterm in kleinbuchstaben umgewandelt
    $searchTerm = strtolower($_GET[GET_PARAM_SEARCH_TEXT]);

    foreach ($ratings as $rating) {
        $rating_to_lower = strtolower($rating['text']);
        if (strpos($rating_to_lower, $searchTerm) !== false) {
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else {
    $showRatings = $ratings;
}

function calcMeanStars(array $ratings) {
    //$sum war vorher 1, dadurch ist der Durchschnitt verfälscht
    $sum = (float) 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / count($ratings);
    }
    return (float) $sum;
}

//Variablen Initialisieren
$showDescription = "";
$languagetext = "DE";
$language = $_deutsch;

session_start();
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <title><?php echo $language['meal']." ". $meal['name']; ?></title>
        <style type="text/css">
            * {
                font-family: Arial, serif;
            }
            .rating {
                color: darkgray;
            }
        </style>
    </head>
    <body>
    <h1><?php echo $language['meal']." ". $meal['name']; ?></h1>

    <!-- Sprache wechseln -->
    <form method= "get">
        <?php
            if (isset($_GET['switch_language'])){
                if(!($_SESSION['switch_language'])){
                    $_SESSION['switch_language'] = 1;
                }
                else{
                    $count_language = $_SESSION['switch_language'] + 1;
                    $_SESSION['switch_language'] = $count_language;
                }
            }
            if(($_SESSION['switch_language'] % 2) === 0) {
                $language = $_englisch;
            }
            else{
                $language = $_deutsch;
            }
            ///Auswahl des Buttons
            $sprache="DE";
            if($language==$_deutsch){
                $sprache="DE";
            }else{
                $sprache="EN";
            }
            echo '<input type="submit" name="switch_language" value="'.$sprache.'">'
        ?>
        <!-- Beschreibung aktivieren / deaktivieren -->
    </form>
        <br>
        <br>
        <form method= "get">
            <?php
                echo '<input type ="submit" name = "show_description" value ="'.$language['btn_desc'].'" ?>';
            ?>
        </form>

        <p> <?php

            if(isset($_GET['show_description'])){
                if(!($_SESSION['show_description'])){
                    $_SESSION['show_description'] = 1;
                }
                else{
                    $count = $_SESSION['show_description'] + 1;
                    $_SESSION['show_description'] = $count;
                }
            }
            if($_SESSION['show_description'] % 2 === 0){
                $showDescription = "<br>";
            }
            else {
                $showDescription = $meal['description'];
            }
            echo "<p>$showDescription</p>";

        ?></p>

    <!-- Rating -->
        <h1><?php echo $language['ratings']." ".calcMeanStars($ratings); ?>)</h1>
        <form method="get">
            <label for="search_text"><?php echo $language['filter'];?></label>
            <?php
                if(isset($_GET['suchen'])){
                    echo '<input id="search_text" type="text" name="search_text" value= "'.$_GET['search_text'].'">';
                }
                else
                {
                    echo '<input id="search_text" type="text" name="search_text">';
                 }
                echo '<input type="submit" name="suchen" value="'.$language['search'].'">';
             ?>

        </form>
        <table class="rating">
            <thead>
            <tr>
                <?php
                    echo "<td>".$language['author']."</td>";
                    echo "<td>".$language['text']."</td>";
                    echo "<td>".$language['stars']."</td>";
                ?>

            </tr>
            </thead>
            <tbody>
            <?php
        foreach ($showRatings as $rating) {
            echo "<tr>
                      <td class = 'rating_name'> {$rating['author']}</td>
                      <td class= 'rating_text'> {$rating['text']}</td>
                      <td class= 'rating_stars'> {$rating['stars']}</td>
                  </tr>";
        }
        ?>
            </tbody>
        </table>
    </body>


</html>