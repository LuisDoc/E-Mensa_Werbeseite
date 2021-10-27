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

function calcMeanStars(array $ratings) : float {
    //$sum war vorher 1, dadurch ist der Durchschnitt verfälscht
    $sum = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / count($ratings);
    }
    return $sum;
}

$showDescription = "";
$counter =0;

if(!empty($_GET[GET_PARAM_SHOW_DESCRIPTION])){
    $counter++;

}


?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <title>Gericht: <?php echo $meal['name']; ?></title>
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
        <h1>Gericht: <?php echo $meal['name']; ?></h1>
        <form mehtod= "get">
            <input type ="submit" id = "show_description" name = "show_description" value ="Click to show Text">
        </form>
        <?php
            echo "<p>".$counter."</p>";
        ?>
        <h1>Bewertungen (Insgesamt: <?php echo calcMeanStars($ratings); ?>)</h1>
        <form method="get">
            <label for="search_text">Filter:</label>
            <input id="search_text" type="text" name="search_text">
            <input type="submit" value="Suchen">
        </form>
        <table class="rating">
            <thead>
            <tr>
                <td>Author</td>
                <td>Text</td>
                <td>Sterne</td>
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
    <h1>Allergene</h1>
    <ul>
        <?php
        $content = 0;
            //Ausgabe aller Allergene in einer unsortieren Liste
            foreach($allergens as $content){
                echo "<li>".$content."</li>";
            }
        ?>
    </ul>
</html>