<?php

class SignupController extends Signup{
    public $email;
    public $password;
    public $password_confirmation;

    public function __construct($password, $password_confirmation, $email){
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;
        $this->email = $email;
    }

    private function NotEmptyInput(){
        $ret;
        if(empty($this->email) || empty($this->password) || empty($this->password_confirmation)){
            $ret = false;
        }else{
            $ret = true;
        }
        return $ret;
    }
     
    private function validEmail(){
        $ret;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $ret=false;
        }else{
            $ret=true;
        }

        return $ret;
    }

    private function UserNotExisting(){
        $ret;
        if($this->checkIfUserExists($this->email)){
            $ret=false;
        }else{
           $ret=true;
        }
        return $ret;
      }
    
    private function passwordEqual(){
        $ret;
        if($this->password !== $this->password_confirmation){
            $ret = false;
        }else{
            $ret =true;
        }
        return $ret;
    }

    public function signupUser(){
        if($this->NotEmptyInput()===false){
            header("Location: ../authentication.php?error=emptyfields");
        }
        if($this->validEmail()===false){
            header("Location: ../authentication.php?error=invalidEmail");
        }
        if($this->passwordEqual()===false){
            header("Location: ../authentication.php?error=passworderror");
        }
        if($this->UserNotExisting()===false){
            header("Location: ../authentication.php?error=userexisting");
        }

        $this->setUser($this->password, $this->email);
    }


}