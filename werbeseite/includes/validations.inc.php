<?php
function InvalidUsername($vorname){
    if(!preg_match("/^[a-zA-Z0-9]*$/", $vorname)){
        return true;
    }
    return false;
}

function InvalidEmail($email){
    $blacklist= [
        'rcpt',
        'damnthespam',
        'wegwerfmail',
        'trashmail',
    ];

    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
       foreach($blacklist as $element){
           if(str_contains($email,$element)){
               return true;
           }
       }

    }
    return false;
}