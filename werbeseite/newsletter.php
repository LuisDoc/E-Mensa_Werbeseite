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
        header("Location: index.php?error=invalidUsername&mail=$email#Newsletter");
        exit();
    }
    if(InvalidEmail($email)!==false){
        header("Location: index.php?error=invalidEmail&username=$vorname#Newsletter");
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
    /* optionale*/
    /*require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer(true);
    try{
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host ="smtp.gmail.com";
        $mail->SMTPAuth =true;
        $mail->Username ="testfuermails1234@gmail.com";
        $mail->Password ="TemporaeresPasswort1234";
        $mail->Port =465;
        $mail->SMTPSecure="ssl";

        $mail->addAddress('testfuermails1234@gmail.com', 'Temp');
        $message = "Name: " .$vorname . "\r\n";
        $message .= "Email: ".$email ."\r\n";
        $message .= "hat sich für den Newsletter angemeldet";
        $message =wordwrap($message,80);

        $mail->isHTML(true);
        $mail->Subject ="Newsletteranmeldung";
        $mail->Body ="<p>$message</p>";
        $mail->AltBody =$message;

        if(!$mail->send()){
            echo "Mailer Error";
        }else{
            header("Location: index.php?error=success#Newsletter");
        }
        //$mail->send();
        //header("Location: index.php?error=success#Newsletter");

    } catch (Exception $e) {
        echo "Failed to deliver Mail";
    }*/
    header("Location: index.php?error=success#Newsletter");

}else{
    header("Location:index.php");
}
exit();