<?php


if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $pwdConfirmation = $_POST['password_confirmation'];

    include ("../classes/dbh.classes.php");
    include ("../classes/signup.classes.php");
    include ("../classes/signupController.classes.php");

    $signup = new SignupController($pwd, $pwdConfirmation, $email);
    $signup->signupUser();
    header("Location: ../authentication.php?error=none");
    
}else{
    header("Location: ../authentication.php");
}