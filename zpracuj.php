<?php
/**
 * Created by PhpStorm.
 * User: kvitajin
 * Date: 13.8.18
 * Time: 12:37
 */
error_reporting(E_ALL);
require_once ("Database.php");
$database= new Database();
$database->pripojPDO();
$autor=$_POST["autor"];
$kniha=$_POST["kniha"];
$stav=$_POST["stav"];
//echo $autor . " " . $kniha . " " . $stav;

$database->setBook($autor, $kniha, $stav);
header("location:./index.php");