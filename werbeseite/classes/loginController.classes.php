<?php
class LoginController extends Login{
    public $email;
    public $password;
    public function __construct($email, $password){
        $this->email  = $email;
        $this->password = $password;
    }

    public function notEmptyInput(){
        $ret;
        if(empty($this->email) || empty($this->password)){
            $ret = false;
        }else{
            $ret = true;
        }
        
        return $ret;
    }

    public function loginUser(){
        if($this->notEmptyInput()===false){
            header("Location: ../authentication.php?error=emptyfields");
            exit();
        }
        $this->getUser($this->email, $this->password);

    }
}