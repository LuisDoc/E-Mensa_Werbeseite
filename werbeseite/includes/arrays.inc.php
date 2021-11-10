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
function print_menu_with_database(){
    $link = mysqli_connect(
        "localhost",
        "root",
        "",
        "emensawerbeseite",
        3306
    );

    if (!$link){
        echo "Verbindung zur Datenbank fehlgeschlagen: ",mysqli_connect_error();
        exit();
    }
    //fehler ausgabe
    $error = mysqli_error($link);
    echo $error;

    $sql = "select name ,preis_intern, preis_extern
            from gericht
            order by name asc
            ";

    $result = mysqli_query($link, $sql);

    if (!$result) {
        echo "Fehler während der Abfrage: ", mysqli_error($link);
        exit();
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $sql2 = "select gha.code 
                from gericht g
                left join gericht_hat_allergen gha 
                on g.id = gha.gericht_id
                where g.name = '{$row['name']}'";

        $allergene = mysqli_query($link, $sql2);

        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['preis_intern']}</td>
                <td>{$row['preis_extern']}</td>
                <td>";
        //Wenn Allergene vorhanden sind wurden sie über eine zweite Query ermittelt
        //Und werden jetzt ausgegeben
        if ($allergene) {
            $counter = 0;
            while($a = mysqli_fetch_assoc($allergene)) {
                if ($counter != 0){
                    echo ", ";
                }
                echo $a['code'];
                $counter++;
            }
        }
        echo "</td>
                <td>Noch kein Bild vorhanden</td>
            </tr>";
    }
    mysqli_free_result($allergene);
    mysqli_free_result($result);
    mysqli_close($link);
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