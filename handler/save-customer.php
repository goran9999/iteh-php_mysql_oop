<?php
include '../dbBroker.php';
include '../model/komitent.php';

session_start();

if(isset($_POST['naziv'])&&isset($_POST['pib'])&&isset($_POST['adresa'])){
    $id=$_SESSION['izdavac_id'];
    $kupac=new Komitent(null,$_POST['naziv'],$_POST['pib'],$_POST['adresa'],$id);
    $status=Komitent::dodajKomitenta($kupac,$conn);
    echo $status;
    if($status){
        echo 'Success';
    }else{
        echo $status;
        echo 'Failed';
    }

}

?>