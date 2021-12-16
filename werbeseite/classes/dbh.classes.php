<?php

class DBH{
    protected $pdo;
    protected function connect(){
        if ($this->pdo) {
            return;
        }else{
            try{
                $username = "root";
                $password = "";
                $this->pdo = new PDO('mysql:dbname=emensawerbeseite;host=localhost', $username, $password);
                return $this->pdo;
            }
            catch(Exception $e){
                echo $e->getMessage();
                die();
            }
        }
        
    }
}

