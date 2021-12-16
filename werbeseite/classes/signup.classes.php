<?php



class Signup extends DBH{
    protected function checkIfUserExists($email){
        $loginquery = "SELECT * FROM benutzer WHERE email = ?;";
        $this->connect();
        $stmt = $this->pdo->prepare($loginquery);

        if(!$stmt->execute(array($email))){
            $stmt = null;
            header("Location: ../authentication.php?error=stmtfailed");
            exit();
        }
        $ret;
        if($stmt->rowCount()>0){
            $ret=true;
        }else{
            $ret=false;
        }
        return $ret;
    }

    protected function setUser($password, $email){
        $this->connect();
        $stmt= $this->pdo->prepare(
            'INSERT INTO benutzer (email, passwort, admin, anzahlfehler, anzahlanmeldungen, letzteanmeldung, letzterfehler) VALUES(?,?,?,?,?,?,?);');
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            $currentDateTime = date('Y-m-d H:i:s');
            if(!$stmt->execute(array($email,$hashedPwd, false, 0, 0, $currentDateTime, NULL))){
                $stmt=null;
                header("Location: ../authentication.php?error=stmtfailed");
            }
            $stmt = null;
        
    }

}