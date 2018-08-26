<?php
/**
 * User: kvitajin
 * Date: 9.8.18
 * Time: 10:53
 */
require_once ("heslo.php");
session_start();
$passwd=$_POST["passwd"];
$saved=passwd();

if ($passwd==$saved){
    $_SESSION["passwd"]=htmlentities($passwd,ENT_QUOTES);
    header("Location:./index.php");
    }
    else{
    throw new Exception("Špatné heslo");
    }