<?php

$host= "localhost";
$db = "fakture";
$user = "root";
$pass = "";

$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_errno){
    exit("Neuspesna konekcija: greska>".$conn->connect+error.", err kod>".$conn->connect->errno);
}




?>