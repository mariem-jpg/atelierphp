<?php
define("HOST","localhost");
define("USER","root");
define("PASS","");
function connect($base){
    $dsn="mysql:host=".HOST.";dbname=".$base;
    $user=USER;
    $pass=PASS;
    try{
        $idcom=new PDO($dsn,$user,$pass);
        return $idcom;
        //echo "connected successfully;
    }
    catch(PDOException $except){
        echo"Echec de la connection",$except_>getMessage();
        return FALSE;
        exit();
    }
}