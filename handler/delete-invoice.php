<?php
include '../dbBroker.php';
include '../model/faktura.php';

session_start();
print_r($_POST);
if(isset($_POST['id_izbrisi'])){
    $faktura=new Faktura($_POST['id_izbrisi']);
    $status=$faktura->izbrisiPoId($conn);
    if($status){
        echo "Success";
    }else{
        echo $status;
        echo "Failed";
    }
}




?>