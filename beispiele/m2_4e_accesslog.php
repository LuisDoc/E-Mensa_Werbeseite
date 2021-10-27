<?php
/**
 * Praktikum DBWT. Autoren:
 * Luis, Diniz Do Carmo, 3275829
 * Niluschen, Liyanaarachchi, 3272466
 */
/*
 * File wird beim schreiben gelöscht
 * Daher vorher das File vorher lesen, dann hinzufügen
 */

//Neue Informationen ins File schreiben

$file = fopen('./accesslog.txt','w');





$browser = $_SERVER['HTTP_USER_AGENT'];
$line = "Datum: ".date('d-m-Y')."\rUhrzeit: ".date("H:i")."\rIP-Adresse: ".$_SERVER['REMOTE_ADDR']."\rWebbrowser: ".($browser)."\r";
fwrite($file, $line);