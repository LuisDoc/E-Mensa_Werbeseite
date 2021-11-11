<?php
/**
 * Praktikum DBWT. Autoren:
 * Luis, Diniz Do Carmo, 3275829
 * Nilusche, Liyanaarachchi, 3272466
 */
function InvalidUsername($vorname){
    if(empty($vorname))
        return true;
    if(!preg_match("/^[a-zA-Z]*$/", $vorname)){
        return true;
    }
    return false;
}

function InvalidEmail($email){
    if(empty($email))
        return true;
    $blacklist= [
        'rcpt.at',
        'damnthespam.at',
        'wegwerfmail.de',
        'trashmail.de',
        'trashmail.com'
    ];

    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $parts =explode('@', $email);
        $domain = array_pop($parts);

        if(in_array($domain, $blacklist)){
            return true;
        }
        return false;

    }else{
        return true;
    }
}
