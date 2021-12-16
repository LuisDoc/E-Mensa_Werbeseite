<?php
if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    include("../classes/dbh.classes.php");
    include("../classes/login.classes.php");
    include("../classes/loginController.classes.php");

    $login = new LoginController($email, $password);
    $login->loginUser();
    header("Location: ../index.php?error=none"); 

}else{
    header("Location: ../authentication.php");
}