<?php
include '../model/izdavac.php';
include '../dbBroker.php';

if(isset($_POST['naziv'])&&isset($_POST['pib'])&&isset($_POST['adresa'])&&isset($_POST['username'])&&isset($_POST['password'])){
    $naziv=$_POST['naziv'];
    $pib=$_POST['pib'];
    $adresa=$_POST['adresa'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $izdavac=new Izdavac(null,$_POST['naziv'],$_POST['pib'],$_POST['adresa'],$_POST['username'],$_POST['password']);
    $status=Izdavac::registrujIzdavaca($izdavac,$conn);
    if($status){
        echo 'Success';
    }else{
      echo $status;
      echo "Failed";
    }

}

?>