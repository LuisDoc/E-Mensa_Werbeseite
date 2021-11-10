<?php
/**
 * Praktikum DBWT. Autoren:
 * Luis, Diniz Do Carmo, 3275829
 * Nilusche, Liyanaarachchi, 3272466
 */

function print_important(){
    $wichtig= [
        "Beste frische saisonale Zutaten",
        "Ausgewogene abwechlungsreiche Zutaten",
        "Sauberkeit"
    ];
    foreach($wichtig as $element){
        echo "<li>". $element ."</li>";
    }
}
function print_menu(){

    $menu = [
        1 => ["Rindfleisch mit Bambus,<br> Kaiserschoten und rotem Paprika, dazu Mie Nudeln", 3.50, 6.20,'<img class="speiseplanimage"src="image/Rindfleisch_mit_Paprika_und_Bambus.jpg" alt="Rindfleisch">'],
        2 => ["Spinatrisotto mit kleinen Samosateigecken <br> und gemischter Salat", 2.90,5.30, '<img class="speiseplanimage"src="image/Spinatrisotto_mit_kleinen_Samosateigecken.jpg" alt="Spinatrisotto">'] ,
        3 => ["Nudeln mit Reis und Salz<br>",4.99, 8.60,'<img class="speiseplanimage"src="image/Reis_mit_Nudeln.jpg" alt="Reis">'],
        4 => ["Portion Mayonnaise mit Mayonnaise", 3.50, 6.50, '<img class="speiseplanimage"src="image/Mayonnaise.jpg" alt="Mayonnaise">'],
        5 => ["Dönerpizza", 4.50, 7.50, '<img class="speiseplanimage"src="image/Dönerpizza.png" alt="Dönerpizza">'],
        6 => ["...", "...","..."]
    ];
    $_SESSION['menuCounter'] = sizeof($menu)-1;

    foreach($menu as $key=> $value){
        echo "<tr>";
        foreach($value as $element){
                echo "<td>".$element ."</td>";
        }
        echo "</tr>";
    }
}

function print_emensa(){
    $statistik= ["Y Anmeldungen zum Newsletter"];
    if(isset($_SESSION['visitCounter'])){
        $_SESSION['visitCounter']++;
    }else{
        $_SESSION['visitCounter']=0;
    }
    echo '<div class="grid-mensa">'.$_SESSION['visitCounter'].' Besuche</div>';
    echo '<div class="grid-mensa">'.$_SESSION['newsletterCounter'].' Anmeldungen zum Newsletter</div>';

    //SQL Abfrage Menu Counter


    echo '<div class="grid-mensa">'.$_SESSION['menuCounter'].' Speisen</div>';

    //Vorher Menu Counter über Session
    //echo '<div class="grid-mensa">'.$_SESSION['menuCounter'].' Speisen</div>';
}