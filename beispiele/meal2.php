<?php
/**
 * Praktikum DBWT. Autoren:
 * Luis, Diniz Do Carmo, 3275829
 * Nilusche, Liyanaarachchi, 3272466
 */
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_PARAM_SHOW_DESCRIPTION ='selected_description';
const GET_PARAM_CHANGE_LANGUAGE ='selected_language';

/**
 * List of all allergens.
 */
$_deutsch =[

    'meal' => 'Gericht',
    'btn_desc' => 'Beschreibung anzeigen/ausblenden',
    'ratings' => 'Bewertungen (Insgesamt:',
    'filter' => 'Filter:',
    'search' => 'Suchen',
    'author' => 'Autor',
    'text' => 'Text',
    'stars' =>'Sterne',
    'allergenes' => 'Allergene',
    'button_language' => 'DE',
    'price' =>'Preis',
    'intern' => 'intern',
    'extern' => 'extern',
    'yes' => 'ja',
    'no' => 'nein',
    'Language' =>'English'

];
$_englisch = [
    'meal' => 'Meal',
    'btn_desc' => 'Show/Hide Description',
    'ratings' => 'Ratings (in total: ',
    'filter' => 'Filter:',
    'search' => 'Search',
    'author' => 'Author',
    'text' => 'Text',
    'stars' => 'Stars',
    'allergenes' => 'Allergenes',
    'button_language' => 'EN',
    'price' =>'Price',
    'intern' => 'intern',
    'extern' => 'extern',
    'yes' => 'yes',
    'no' => 'no',
    'Language' =>'German'
];

$language= $_deutsch;
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
$showDescription = "<br>";
$languagetext = "DE";
$language = $_deutsch;

session_start();


//sprache Einstellen nach letzter vorhandener Sitzung
if($_SESSION[GET_PARAM_CHANGE_LANGUAGE]=="EN" && !isset($_GET['sprache'])){
    $language=$_englisch;
}else{
    $language=$_deutsch;
}
//Beschreibung Anzeigen nach letzter vorhandener Sitzung
if($_SESSION[GET_PARAM_SHOW_DESCRIPTION]=="0" && !isset($_GET['show_description'])){
    $showDescription ="<br>";
}else{
    $showDescription =$meal['description'];
}

//Sprache Wechseln
if(isset($_GET['sprache'])){
    if($_GET['sprache']=="EN"){
        $language=$_englisch;
        $_SESSION[GET_PARAM_CHANGE_LANGUAGE]="EN";
    }else{
        $language=$_deutsch;
        $_SESSION[GET_PARAM_CHANGE_LANGUAGE]="DE";
    }
}

//Beschreibung wechseln
if(isset($_GET['show_description'])){
    if($_GET['show_description']=="0"){
        $showDescription ="<br>";
        $_SESSION[GET_PARAM_SHOW_DESCRIPTION]="0";
    }else{
        $showDescription =$meal['description'];
        $_SESSION[GET_PARAM_SHOW_DESCRIPTION]="1";
    }
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <?php
    echo "<title>".$language['meal'].": ".$meal['name']."</title>";
    ?>
    <title>
        <?php
        echo $language['meal']." ". $meal['name']; ?>
    </title>
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

<!-- Sprache wechseln -->
<form method="get">
    <button type="submit" name="language"><?php echo $language['Language']?></button>
</form>
<br>
<?php
if(isset($_GET['language'])){
    //Togglen der Sprache
    if($_SESSION[GET_PARAM_CHANGE_LANGUAGE]=="DE"){
        $_SESSION[GET_PARAM_CHANGE_LANGUAGE]="EN";
    }else{
        $_SESSION[GET_PARAM_CHANGE_LANGUAGE]="DE";
    }
    $selectedlanguage=$_SESSION[GET_PARAM_CHANGE_LANGUAGE];

    header("Location:meal2.php?sprache=$selectedlanguage");
}
?>
<h1>
    <?php echo $language['meal']." ". $meal['name']; ?>
</h1>

<!-- Beschreibung aktivieren-->
<form method="get">
    <button type="submit" name="selectDescription"><?php echo $language['btn_desc']?></button>
</form>
<?php
if(isset($_GET['selectDescription'])){
    //Togglen der Beschreibung
    if($_SESSION[GET_PARAM_SHOW_DESCRIPTION]=="1"){
        $_SESSION[GET_PARAM_SHOW_DESCRIPTION]="0";
    }else{
        $_SESSION[GET_PARAM_SHOW_DESCRIPTION]="1";
    }
    $selected_description=$_SESSION[GET_PARAM_SHOW_DESCRIPTION];

    header("Location:meal2.php?show_description=$selected_description");
}
?>

<p>
    <?php
    echo $showDescription;
    ?>
</p>

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

<!-- Preise -->
<h1><?php echo $language['price']?></h1>
<ul>
    <?php

    echo $meal['name']."<br>";
    echo $language['intern'].": ". $language['price'].": ".number_format($meal['price_intern'],2).'€' ."<br>";
    echo $language['extern'].": ". $language['price'].": ".number_format($meal['price_extern'],2).'€' ."<br>";

    ?>
</ul>
<h1><?php echo $language['allergenes']?></h1>
<ul>
    <?php
    $content = 0;
    //Ausgabe aller Allergene in einer unsortieren Liste
    foreach($allergens as $content){
        echo "<li>".$content."</li>";
    }
    ?>
</ul>
</body>


</html>
