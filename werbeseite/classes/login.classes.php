<?php

class Login extends DBH{

    protected function getUser($email, $password){
            $this->connect();
            try{
                $this->pdo->beginTransaction();
                $stmt =  $this->pdo->prepare('SELECT * FROM benutzer  WHERE email = ?;');
                $stmt->execute(array($email));
                $this->pdo->commit();
            }catch(Exception $e){
                $stmt = null;
                $this->pdo->rollback();
                header("Location: ../authentication.php?error=stmtfailed");
                exit();
                
            }
            

            if($stmt->rowCount()==0){
                $stmt = null;
                header("Location: ../authentication.php?error=usernotFound1");
                exit();
            }

            $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $checkPWD = password_verify($password, $pwdHashed[0]["passwort"]);
            
            if(!$checkPWD){
                $currentDateTime = date('Y-m-d H:i:s');
                try{
                    $this->pdo->beginTransaction();
                    $stmt =  $this->pdo->prepare('UPDATE benutzer SET letzterfehler= ? WHERE email = ?;');
                    $stmt->execute(array($currentDateTime, $email));
                    $stmt =  $this->pdo->prepare('UPDATE benutzer SET anzahlfehler= ? WHERE email = ?;');
                    $stmt->execute(array(++$pwdHashed[0]["anzahlfehler"], $email));
                    $this->pdo->commit();
                }catch(Exception $e){
                    $stmt = null;
                    $this->pdo->rollback();
                    header("Location: ../authentication.php?error=stmtfailed");
                    exit();
                }   
                header("Location: ../authentication.php?error=wrongpassword");
                exit();

            }
            else
            {
                try{
                    $this->pdo->beginTransaction();
                    $stmt =  $this->pdo->prepare('SELECT * FROM benutzer WHERE email = ?;');
                    $stmt->execute(array($email));
                    $this->pdo->commit();
                }catch(Exception $e){
                    $stmt = null;
                    $this->pdo->rollback();
                    header("Location: ../authentication.php?error=stmtfailed");
                    exit();
                }

                if($stmt->rowCount()==0){
                    $stmt=null;
                    header("Location: ../authentication.php?error=usernotFound2");
                    exit();
                }

                $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                try{
                    $this->pdo->beginTransaction();
                    $stmt =  $this->pdo->prepare('UPDATE benutzer SET anzahlanmeldungen=? WHERE email =?;');
                    $stmt->execute(array(++$user[0]["anzahlanmeldungen"], $email));
                    $this->pdo->commit();
                }catch(Exception $e){
                    $stmt = null;
                    $this->pdo->rollback();
                    header("Location: ../authentication.php?error=stmtfailed");
                    exit();
                }
                

            
                session_start();
                $_SESSION['userid'] = $user[0]["id"];
                $_SESSION['useremail'] =$user[0]["email"];

                $stmt=null;
            }

        
    }
    

}