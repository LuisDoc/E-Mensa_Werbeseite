<?php
session_start();
if(isset($_POST['submit'])){
    //CSRF Token überprüfe
    if(!$_POST['CSRFtoken']){
        header("Location:wunschgerichte.php?error=tokennotexisting");
        exit();
    }
    if($_POST['CSRFtoken'] !==$_SESSION['token']){
        //header($_SERVER['SERVER_PROTOCOL'].'405 Method not allowed');
        header("Location:wunschgerichte.php?error=tokeninvalid");
        //header("Location:wunschgerichte.php?error=tokennotidentical");
        exit();
    }
    $name = $_POST['name'];
    $email = $_POST['email'];
    $beschreibung = $_POST['beschreibung'];
    $gerichtname = $_POST['gerichtname'];
    require "includes/validations.inc.php";
    if(InvalidUsername($name)){
        header("Location: wunschgerichte.php?error=invalidName");
        exit();
    }

    if(InvalidEmail($email)){
        header("Location: wunschgerichte.php?error=invalidEmail");
        exit();
    }

    if(InvalidWunschgerichtName($gerichtname)){
        header("Location: wunschgerichte.php?error=invalidGerichtname");
        exit();
    }

    date_default_timezone_set('Europe/Berlin');
    $date = date("Y/m/d");
    $conn= new mysqli('localhost','root','','emensawerbeseite',3306);
    $stmt = $conn->prepare("INSERT INTO emensawerbeseite.ersteller (name, email) VALUES(?,?) ON DUPLICATE KEY UPDATE email = ?;");
    $stmt->bind_param('sss',$name, $email,$email);
    if(!$stmt->execute()){
        echo $stmt->error;
       // header("Location: wunschgerichte.php?error=stmterror");
        exit();
    }


    $stmt = $conn->prepare("INSERT INTO emensawerbeseite.wunschgericht 
    (wunschgericht.gerichtname, wunschgericht.beschreibung, wunschgericht.ersteller_email, wunschgericht.created_at) VALUES(?,?,?,?)");
    $stmt->bind_param('ssss', $gerichtname,$beschreibung, $email,$date);
    if(!$stmt->execute()){

        echo $stmt->error;
        //header("Location: wunschgerichte.php?error=stmterror");
        exit();
    }

    unset($_SESSION['token']);
    header("Location: wunschgerichte.php?error=success");

}else{
    header("Location:wunschgerichte.php");
    exit();
}
