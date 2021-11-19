<?php
/**
 * Praktikum DBWT. Autoren:
 * Luis, Diniz Do Carmo, 3275829
 * Nilusche, Liyanaarachchi, 3272466
 */

session_start();

//Wenn Daten an Newsletter über Post geschickt wurden
if(isset($_POST['Newsletter'])){
    $vorname = $_POST['Vorname'];
    $email = $_POST['email'];
    $language =$_POST['language'];
    require_once "includes/validations.inc.php";

    //Wenn der Vorname falsch ist --> Siehe validations
    //wird über ?error in der Index ein Fehler ausgegeben
    if(InvalidUsername($vorname)!==false){
        header("Location: index.php?error=invalidUsername#Newsletter");
        exit();
    }
    //Wenn die Email Adresse falsch ist -> Siehe validations
    //wird über ?error in der Index ein Fehler ausgegeben
    if(InvalidEmail($email)!==false){
        header("Location: index.php?error=invalidEmail#Newsletter");
        exit();
    }

    //Öffnen der Schreibdatei
    $file = fopen('persons.csv', 'a');
    //Array das eine Person abbildet
    $person = array($vorname, $email, $language);
    //Schreiben in Datei
    fputcsv($file, $person);
    //Schließen der Datei um Fehler zu verhindern
    fclose($file);


    //Wenn der NewsletterCounter noch nicht existiert, wird dieser initailisiert
    if(!isset($_SESSION['newsletterCounter'])){
        $_SESSION['newsletterCounter'] =1;
    }
    //Inkrementierung wenn NewsletterCounter bereits initialisiert wurde
    else{
        $_SESSION['newsletterCounter']++;
    }
    //Zurückleitung auf Index.php an den Anker Newsletter
    header("Location: index.php?error=success#Newsletter");

}else{
    header("Location:index.php");
}
exit();