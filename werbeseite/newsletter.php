<?php
/**
 * Praktikum DBWT. Autoren:
 * Luis, Diniz Do Carmo, 3275829
 * Nilusche, Liyanaarachchi, 3272466
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();

if(isset($_POST['Newsletter'])){
    $vorname = $_POST['Vorname'];
    $email = $_POST['email'];
    $language =$_POST['language'];
    require_once "includes/validations.inc.php";

    if(InvalidUsername($vorname)!==false){
        header("Location: index.php?error=invalidUsername#Newsletter");
        exit();
    }
    if(InvalidEmail($email)!==false){
        header("Location: index.php?error=invalidEmail#Newsletter");
        exit();
    }


    $file = fopen('persons.csv', 'a');
    $person = array($vorname, $email, $language);
    fputcsv($file, $person);
    fclose($file);
    if(!isset($_SESSION['newsletterCounter'])){
        $_SESSION['newsletterCounter'] =1;
    }
    else{
        $_SESSION['newsletterCounter']++;
    }
    header("Location: index.php?error=success#Newsletter");

}else{
    header("Location:index.php");
}
exit();