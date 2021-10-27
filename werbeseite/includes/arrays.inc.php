<?php

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
        1 => ["Rindfleisch mit Bambus,<br> Kaiserschoten und rotem Paprika, dazu Mie Nudeln", 3.50, 6.20],
        2 => ["Spinatrisotto mit kleinen Samosateigecken <br> und gemischter Salat", 2.90,5.30],
        3 => ["...", "...","..."]
    ];

    foreach($menu as $key=> $value){
        echo "<tr>";
        foreach($value as $element){
            echo "<td>".$element ."</td>";
        }
        echo "</tr>";
    }
}

function print_emensa(){
    $statistik= ["X Besuche","Y Anmeldungen zum Newsletter","Speisen"];
    foreach($statistik as $element){
        echo '<div class="grid-mensa">' . $element ."</div>";
    }
}
